<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Alumno;
class AlumnoControllerTest1 extends TestCase
{
    public function puede_crear_un_alumno()
    {
        $response = $this->post('/alumnos', [
            'name' => 'Juan',
            'lastname' => 'Perez',
            'mail' => 'juan.perez@example.com',
            'age' => 20,
        ]);

        $response->assertRedirect('/alumnos'); // verifica que redirija a la lista de alumnos
        $this->asserDatabaseHas('alumnos', [
            'nombre' => 'Juan',
            'lastname' => 'Perez',
            'mail' => 'juan.perez@example.com',
            'age' => 20,
        ]);
    }
}
