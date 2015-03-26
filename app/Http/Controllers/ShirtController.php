<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Shirt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ShirtController extends Controller {

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $shirts = Shirt::all();

		return view('shirts.index', ['shirts' => $shirts]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $file = \Request::file('shirt');

        Storage::disk('local')->put($file->getClientOriginalName(),  File::get($file));

        $shirt = new Shirt();
        $shirt->mime = $file->getClientMimeType();
        $shirt->name = $file->getClientOriginalName(); //todo: improve security
        $shirt->user_id = $this->auth->user()->getAuthIdentifier();

        $shirt->save();

        return redirect()->route('shirt.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($name)
	{
        $shirt = Shirt::where('name', '=', $name)->firstOrFail();
        $file = Storage::disk('local')->get($shirt->name);

        return (new \Illuminate\Http\Response($file, 200))
            ->header('Content-Type', $shirt->mime);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
