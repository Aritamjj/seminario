<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Alumno;
class AlumnoControllerTest extends TestCase
{

    use RefreshDatabase; // Refresca la base de datos despues de cada prueba

    /** @test */
    public function puede_crear_un_alumno()
    {
        $response = $this->post('/alumnos', [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);

        $response->assertRedirect('/alumnos'); // verifica que redirija a la lista de alumnos
        $this->assertDatabaseHas('alumnos', [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);
    }

    /** @test */
    public function puede_mostrar_detalles_de_un_alumno()
    {
        $alumno = Alumno::factory()->create();
        //dd($alumno);
        $response = $this->get("/alumnos/{$alumno->id}");
        //dd($response);
        $response->assertStatus(200); // Verifica que la solicitud fue exitosa
        $response->assertSee($alumno->nombre);
        $response->assertSee($alumno->apellido);
    }

    /** @test */
    public function puede_actualizar_un_alumno()
    {
        // Configuracion de la prueba: Creacion de un alumno inicial
         $alumno = Alumno::factory()->create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);

        // Ejecutar la accion: Enviar una solicitud PUT para actualizar los datos
        $response = $this->put("/alumnos/{$alumno->id}", [
            'nombre' => 'Carlos',
            'apellido' => 'García',
            'email' => 'carlos.garcia@example.com',
            'edad' => 22,
        ]);

        // Verificar la redireccion despues de la actualizacion
        $response->assertRedirect('/alumnos'); // Confirma que redirige a la lista de alumnos

        // Verificar que el registro en la base de datos se haya actualizado con los nuevos datos
        $this->assertDatabaseHas('alumnos', [
            'id' => $alumno->id,            // Asegura que el ID es el mismo (misma fila)
            'nombre' => 'Carlos',           // Nombre actualizacion
            'apellido' => 'García',         // Apellido actualizado
            'email' => 'carlos.garcia@example.com',     // Email actualizado
            'edad' => 22,                   // Edad actualizada
        ]);

        // Verificar que los datos anteriores ya no existan
        $this->assertDatabaseMissing('alumnos', [
            'id' => $alumno->id,
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);

    }
    
}