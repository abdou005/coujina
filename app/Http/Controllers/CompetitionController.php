<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;
use App\Repositories\CompetitionRepository;
use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function getCompetitions(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->input('start');
            $length = $request->input('length');
            $draw = $request->input('draw');
            $startAt = $request->input('start_at', null);
            $endAt = $request->input('end_at', null);
            $type = $request->get('type');
            $name = $request->input('name', null);
            $competitions = CompetitionRepository::searchCompetitionByFilter((int)$type, $start, $length, strtotime($startAt), strtotime($endAt), $name);
            $competitions->each(function(Competition $competition) {
                $competition->start_at = date("d-m-Y", $competition->start_at);
                $competition->end_at = date("d-m-Y", $competition->end_at);
            });
            $response = [
                'draw' => $draw,
                "recordsTotal" => $competitions->total(),
                "recordsFiltered" => $competitions->total(),
                "data" => $competitions->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.competitions.competitions-layout-list');
    }

    public function addCompetition(CompetitionRequest $request)
    {
        $name = $request->get('name');
        $type = $request->get('type');
        $startAt = $request->get('start_at');
        $endAt = $request->get('end_at');
        $image = $request->file('image');
        $address = $request->input('address', null);
        $desc = $request->input('desc', null);
        $path = uploadFile($image, 'events', time());
        CompetitionRepository::createCompetition($name, $type, strtotime($startAt), strtotime($endAt), $path, $address, $desc);
        return response()->json(['status' => 'success', 'message' => 'Competition ajoutée avec succes'], 200);
    }

    public function findCompetition($competitionId)
    {
        $competition = Competition::findOrFail($competitionId);
        $competition->start_at = date("d-m-Y", $competition->start_at);
        $competition->end_at = date("d-m-Y", $competition->end_at);
        return response()->json($competition, 200);
    }

    public function updateCompetition($competitionId, CompetitionRequest $request)
    {
        $competition = Competition::findOrFail($competitionId);
        $name = $request->get('name');
        $type = $request->get('type');
        $startAt = $request->get('start_at');
        $endAt = $request->get('end_at');
        $image = $request->file('image');
        $address = $request->input('address', $competition->address);
        $desc = $request->input('desc', $competition->desc);
        $path = $competition->image;
        if ($image) {
            $path = uploadFile($image, 'events', time());
            if ($competition->image && file_exists(public_path($competition->image))) {
                unlink(public_path($competition->image));
            }
        }
        $competitionRepository = new CompetitionRepository($competition);
        $competitionRepository->updateCompetition($name, $type, strtotime($startAt), strtotime($endAt), $path, $address, $desc);
        return response()->json(['status' => 'success', 'message' => 'Competition modifiée avec succes'], 200);
    }

    public function deleteCompetition($sliderId)
    {
        $competition = Competition::findOrFail($sliderId);
        $time = time();
        if ($time >= $competition->start_at && $time < $competition->end_at) {
            return response()->json(['status' => 'error', 'message' => 'slider_delete_error_time'], 404);
        }
        $competition->delete();
        if ($competition->image && file_exists(public_path($competition->image))) {
            unlink(public_path($competition->image));
        }
        return response()->json(['status' => 'success', 'message' => 'Competition supprimée avec succes'], 200);
    }
}