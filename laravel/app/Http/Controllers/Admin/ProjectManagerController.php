<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectManager as Manager;

class ProjectManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::orderBy('name');
        $managers = $managers->paginate(25);

        return view('admin.manager.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:project_managers',
            'password' => 'required|min:6|confirmed',
        ]);
        $manager = Manager::create([
            'name'          => $request->name,
            'email'        => $request->email,
            'password'      => bcrypt($request->password),
            
        ]);
        session_success("{$manager->name} Project Manager is successfully added.");
        return redirect()->route('admin.manager.show', $manager->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        return view('admin.manager.show', compact(['manager']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        return view('admin.manager.edit', compact(['manager']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
        $manager->update([
            'name'          => $request->name,
            'password'      => bcrypt($request->password),
        ]);
        session_success("{$manager->name} Project Manager is successfully updated.");
        return redirect()->route('admin.manager.show', $manager->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();
        return ['status' => 'success', 'message' => 'Successfully Deleted.'];
    }
}
