<?php

namespace App\Http\Controllers;

use App\Models\sites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'descricao' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'url'],
        ]);
    }

    public function index()
    {
        //
        $data['dados'] = Sites::all();

        return view('sites.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $data['status'] = 'Pendente';

        try {

            $urls = Sites::create($data);

            if ($urls) {
                return redirect()->route('home');
            }
        } catch (RequestException $ex) {
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function show(sites $sites)
    {
        //
        return view('sites.show', compact('sites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['sites'] = Sites::findOrFail($id);
        return view('sites.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sites = Sites::findOrFail($id);
        $sites->update($request->all());
        return redirect()->route('home')->with('success', 'Site atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Sites::findOrFail($id);
        $data->delete();
        return redirect()->route('home')->with('success', 'Site excluido!');
    }

    public function testSite($id)
    {
        if ($this->syncStatusSite($id)) {
            return redirect()->route('home')->with('success', 'Site OK!');
        } else {
            return redirect()->route('home')->with('error', 'Site indisponivel!');
        }
    }

    public function testSites()
    {

        $sites = Sites::all();

        foreach ($sites as $site) {
            $this->syncStatusSite($site->id);
        }
    }

    public function syncStatusSite($id)
    {

        $site = Sites::findOrFail($id);
        try {

            $response = Http::get($site->url);

            $ok = $response->ok();
            $body = $response->body();
            $status = $response->status();
        } catch (\Exception $e) {

            $ok = false;
            $body = null;
            $status = 404;
        }

        $site->status = ($ok) ? 'Disponivel' : 'Indisponivel';
        $site->code = $status;
        $site->body = $body;
        $site->atualizacao = date("Y-m-d H:i:s");
        $site->update();

        return $ok;
    }
}