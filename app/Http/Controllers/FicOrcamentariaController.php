<?php

namespace App\Http\Controllers;

use App\Models\FicOrcamentaria;
use App\Models\DotOrcamentaria;
use App\Models\Nota;
use App\Models\Movimento;

use Illuminate\Http\Request;
use App\Http\Requests\FicOrcamentariaRequest;


class FicOrcamentariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->busca != null){
            //$ficorcamentarias = FicOrcamentaria::paginate(5)->sortByDesc('nome');
            $ficorcamentarias = FicOrcamentaria::where('descricao','LIKE','%'.$request->busca.'%')->paginate(10);
        }
        else{
            //$ficorcamentarias = FicOrcamentaria::paginate(5)->sortByDesc('nome');
            $ficorcamentarias = FicOrcamentaria::paginate(10);
        }
        return view('ficorcamentarias.index')->with('ficorcamentarias', $ficorcamentarias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_dotorcamentarias = DotOrcamentaria::lista_dotorcamentarias();
        $lista_descricoes = Nota::lista_descricoes();
        $lista_observacoes = Nota::lista_observacoes();
        return view('ficorcamentarias.create', compact('lista_dotorcamentarias','lista_descricoes','lista_observacoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FicOrcamentariaRequest $request)
    {
        //dd($request->observacao);
        $movimento_ativo = Movimento::movimento_ativo();
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $validated['movimento_id'] = $movimento_ativo->id;

        //$ficorocamentaria->dotacao_id = $request->dotacao_id;
        $validated['dotacao_id'] = $request->dotacao_id;
        //dd($validated);

        FicOrcamentaria::create($validated);

        $request->session()->flash('alert-success', 'Ficha Orçamentária cadastrada com sucesso!');
        return redirect()->route('ficorcamentarias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FicOrcamentaria  $ficorcamentaria
     * @return \Illuminate\Http\Response
     */
    public function show(FicOrcamentaria $ficorcamentaria)
    {
        return view('ficorcamentarias.show', compact('ficorcamentaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FicOrcamentaria  $ficorcamentaria
     * @return \Illuminate\Http\Response
     */
    public function edit(FicOrcamentaria $ficorcamentaria)
    {
        $lista_dotorcamentarias = DotOrcamentaria::lista_dotorcamentarias();
        $lista_descricoes = Nota::lista_descricoes();
        $lista_observacoes = Nota::lista_observacoes();

        return view('ficorcamentarias.edit', compact('ficorcamentaria','lista_dotorcamentarias','lista_descricoes','lista_observacoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FicOrcamentaria  $ficorcamentaria
     * @return \Illuminate\Http\Response
     */
    public function update(FicOrcamentariaRequest $request, FicOrcamentaria $ficorcamentaria)
    {
        $movimento_ativo = Movimento::movimento_ativo();
        $validated = $request->validated();
        //dd(auth()->user()->name);
        $validated['user_id'] = auth()->user()->id;
        //dd($validated);

        $ficorcamentaria->user_id = auth()->user()->id;
        $ficorcamentaria->movimento_id = $movimento_ativo->id;
        $ficorcamentaria->dotacao_id = $request->dotacao_id;

        $ficorcamentaria->update($validated);
        
        $request->session()->flash('alert-success', 'Ficha Orçamentária alterada com sucesso!');
        return redirect()->route('ficorcamentarias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FicOrcamentaria  $ficorcamentaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(FicOrcamentaria $ficorcamentaria)
    {
        $ficorcamentaria->delete();
        return redirect()->route('ficorcamentarias.index')->with('alert-success', 'Ficha Orçamentária deletada com sucesso!');
    }
}
