<?php

namespace App\Http\Controllers;

//use Barryvdh\DomPDF\PDF as PDF;

use App\Models\maestrosModel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    //

    public function oficioAsignacion(Request $request)
{


    $codigoMaestro = $request->input('codigo');
    $maestro = DB::table('maestros')
                 ->where('codigo', $codigoMaestro)
                 ->first();

    // Luego, obtén la lista de tutorados asociados a este maestro
    $tutorados = DB::table('alumno_tutor')
                   ->join('alumnos', 'alumno_tutor.codigo', '=', 'alumnos.codigo')
                   ->where('alumno_tutor.id_tutor', $codigoMaestro)
                   ->select('alumnos.*')
                   ->get();

    $half = ceil($tutorados->count() / 2);

    $pdf = PDF::loadView('pdf.oficio_asignacion',['maestro' => $maestro,
    'tutorados' => $tutorados, 'half'=>$half]);

    return $pdf->download('oficio_asignacion.pdf');
}

public function constanciaTutoria(Request $request)
{
    $codigoMaestro = $request->input('codigo');
    $maestro = DB::table('maestros')
                 ->where('codigo', $codigoMaestro)
                 ->first();

    // Luego, obtén la lista de tutorados asociados a este maestro
    $tutorados = DB::table('alumno_tutor')
                   ->join('alumnos', 'alumno_tutor.codigo', '=', 'alumnos.codigo')
                   ->where('alumno_tutor.id_tutor', $codigoMaestro)
                   ->select('alumnos.*')
                   ->get();

    $half = ceil($tutorados->count() / 2);
     // Tus datos aquí
    $pdf = PDF::loadView('pdf.constancia_tutoria',['maestro' => $maestro,
    'tutorados' => $tutorados, 'half'=>$half]);
    return $pdf->download('constancia_tutoria.pdf');
}
}
