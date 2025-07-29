<?php

namespace Tests\Feature;

use App\Models\Agente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AgenteTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_crear_agente_con_atributos_validos()
    {
        $datosAgente = [
            'nombre' => 'Wraith',
            'rol' => 'assault',
            'habilidad' => 'Puede crear portales dimensionales y volverse invulnerable temporalmente'
        ];

        $response = $this->post(route('agentes.store'), $datosAgente);

        $response->assertRedirect(route('agentes.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('agentes', $datosAgente);
    }

    public function test_evita_agentes_duplicados()
    {
        $agente = Agente::create([
            'nombre' => 'Wraith',
            'rol' => 'assault',
            'habilidad' => 'Habilidad de Wraith'
        ]);

        $datosAgenteDuplicado = [
            'nombre' => 'Wraith', 
            'rol' => 'defensive',
            'habilidad' => 'Otra habilidad'
        ];

        $response = $this->post(route('agentes.store'), $datosAgenteDuplicado);

        $response->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('agentes', 1); 
    }

    public function test_campo_rol_es_obligatorio()
    {
        $datosIncompletos = [
            'nombre' => 'Octane',
            'habilidad' => 'Habilidades de Octane'
        ];

        $response = $this->post(route('agentes.store'), $datosIncompletos);

        $response->assertSessionHasErrors('rol');
        $this->assertDatabaseCount('agentes', 0);
    }

    public function test_campo_nombre_es_obligatorio()
    {
        $datosIncompletos = [
            'rol' => 'support',
            'habilidad' => 'Habilidades del agente'
        ];

        $response = $this->post(route('agentes.store'), $datosIncompletos);

        $response->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('agentes', 0);
    }

    public function test_campo_habilidad_es_obligatorio()
    {
        $datosIncompletos = [
            'nombre' => 'Lifeline',
            'rol' => 'support',
        ];

        $response = $this->post(route('agentes.store'), $datosIncompletos);

        $response->assertSessionHasErrors('habilidad');
        $this->assertDatabaseCount('agentes', 0);
    }

    public function test_solo_acepta_roles_validos()
    {
        $datosInvalidos = [
            'nombre' => 'Bangalore',
            'rol' => 'invalido', // Rol no válido
            'habilidad' => 'Habilidades de Bangalore'
        ];

        $response = $this->post(route('agentes.store'), $datosInvalidos);

        $response->assertSessionHasErrors('rol');
        $this->assertDatabaseCount('agentes', 0);
    }

    public function test_puede_actualizar_agente_existente()
    {
        $agente = Agente::create([
            'nombre' => 'Pathfinder',
            'rol' => 'recon',
            'habilidad' => 'Habilidad original'
        ]);

        $datosActualizados = [
            'nombre' => 'Pathfinder',
            'rol' => 'recon',
            'habilidad' => 'Habilidad actualizada con más detalles'
        ];

        $response = $this->put(route('agentes.update', $agente), $datosActualizados);

        $response->assertRedirect(route('agentes.index'));
        $this->assertDatabaseHas('agentes', $datosActualizados);
    }

    public function test_puede_eliminar_agente()
    {
        $agente = Agente::create([
            'nombre' => 'Caustic',
            'rol' => 'defensive',
            'habilidad' => 'Usa gas tóxico para controlar el área'
        ]);

        $response = $this->delete(route('agentes.destroy', $agente));

        $response->assertRedirect(route('agentes.index'));
        $this->assertDatabaseCount('agentes', 0);
    }
}