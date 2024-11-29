<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\Alumno;
use App\Http\Controllers\AlumnoController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Tests\TestCase;

class AlumnoControllerUnitTest extends TestCase
{
    //Prueba de que al no ingresar datos se genera una excepcion
    /*public function test_probar_validacion_falla_para_crear_Alumnos()
    {
        //variable para el controlador, aqui se crea la instancia de dicho controlador
        $controller = new AlumnoController();
        $request=Request::create('/alumnos','POST',[
            'nombre' => '',//Ingresando dato vacio para comprobar la validacion de required
            'apellido' => '',
            'email' => '',
            'edad' => '',
        ]);
        $this->expectException(ValidationException::class);
        // Se espera que falle la validacion
        $controller->store($request);
    }*/
    /*Prueba de que al ingresar los datos de forma correcta se ejecuta
    la captura de datos correctamente*/
    /*public function test_probar_validacion_correcta_para_crear_Alumnos()
    {
        //variable para el controlador, aqui se crea la instancia de dicho controlador
        $controller = new AlumnoController();
        $request=Request::create('/alumnos','POST',[
            'nombre' => 'Kevin',//Ingresando dato vacio para comprobar la validacion de required
            'apellido' => 'Calix',
            'email' => 'KCalix@unicah.edu',
            'edad' => '20',
        ]);
        $this->expectException(ValidationException::class);
        // Si no se genera una excepcion, la validacion sera correcta
        $response=$controller->store($request);
        $this->assertTrue($response->isRedirect(route('alumnos.index')));
    }*/


    // PRUEBA AssertFalse
    //prueba Validar que el modelo Alumno no contiene un registro con un ID inexistente.
    /** @test */
    public function test_comprobar_assertFalse_alumno_no_existente()
    {
        // Intentar buscar un alumno con un ID inexistente (ejemplo: 99999)
        $alumno = Alumno::find(99999);
        
        // La condición debe ser falsa porque no se encontró el alumno
        $this->assertFalse($alumno !== null);
    }

    // PRUEBA AssertSame
    /** @test */
    public function test_comprobar_assert_same()
    {
        // Crear un alumno de prueba
        $alumno = Alumno::factory()->create([
            'nombre' => 'Maria',
            'apellido' => 'Arita',
            'email' => 'maria@prueba.com',
            'edad' => 25, // Este es el valor que verificaremos
        ]);

        // Verifica que el campo 'edad' sea exactamente igual a 25 (tipo y valor)
        $this->assertSame(25, $alumno->edad);
    }

    // PRUEBA AssertEquals
    /** @test */
    public function test_comprobar_assert_equals()
    {
        // Crear un alumno de prueba
        $alumno = Alumno::factory()->create([
            'nombre' => 'Luis',
            'apellido' => 'Gomez',
            'email' => 'luis@prueba.com',
            'edad' => 30,
        ]);

        // Verifica que el nombre del alumno sea igual al esperado
        $this->assertEquals('Luis', $alumno->nombre);
    }


    //PRUEBA IsNumeric
    /** @test */
    public function Test_Comprobar_Assert_IsNumeric()
    {
        $alumno = Alumno::factory()->create();

        $this->assertIsNumeric($alumno->id); 
    }
}
