<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function __invoke(Request $request)
    {
        $guard = $request->getGuard();
        switch ($guard) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            case 'web':
                return redirect()->route('dashboard');
                break;
            default:
                return redirect('/login');
                break;
        }
    }

    public function index()
    {
        $server = (object) $_SERVER;
        return view('pages.site_settings.index', compact('server'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->site_name) {
                \Cache::put('SiteName', $request->site_name);
            }

            if ($request->has('logoDark')) {
                $path = getFilePath('logo');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                // Image::make($logo)->save($path . '/logo.png');
                $request->logoDark->move($path, '/logo-dark.png');
            }

            if ($request->has('logoLight')) {
                $path = getFilePath('logo');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                // Image::make($logo)->save($path . '/logo.png');
                $request->logoLight->move($path, '/logo-light.png');
            }

            if ($request->has('favicon')) {
                $path = getFilePath('logo');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                // Image::make($logo)->save($path . '/logo.png');
                $request->favicon->move($path, '/favicon.ico');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Update successfully',
                'code' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Image cannot uploaded',
                'errors' => $e->getMessage(),
            ], 422);
        }
    }

    public function optimizeClear()
    {
        \Artisan::call('optimize:clear');
        return back();
    }
}
