<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Page;
use App\Code;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // if (!$request->ajax() )return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;


        if ($buscar == '')
        {
            if ($criterio == 'active') {
                
                // $pages = Page::where('active', '1')->orderBy('id', 'desc')->paginate(6);

                $pages = Page::where('active', '1')->orderBy('id', 'desc')->paginate(6);
                // $pages = Page::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(6);

            }elseif($criterio == 'inactive'){

                // $pages = Page::where('active', '0')->orderBy('id', 'desc')->paginate(6);
                $pages = Page::where('active', '0')->orderBy('id', 'desc')->paginate(6);
            }
            else{
                $pages = Page::orderBy('id', 'desc')->paginate(6);
            }

            
        }
        
        else
        {
            if ($criterio == 'active') {
                
                // $pages = Page::where('active', '1')->orderBy('id', 'desc')->paginate(6);

                $pages = Page::where('page_name', 'like', '%'. $buscar . '%')->where('active', '1')->orderBy('id', 'desc')->paginate(6);
                // $pages = Page::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(6);

            }elseif($criterio == 'inactive'){

                // $pages = Page::where('active', '0')->orderBy('id', 'desc')->paginate(6);
                $pages = Page::where('page_name', 'like', '%'. $buscar . '%')->where('active', '0')->orderBy('id', 'desc')->paginate(6);
            }else{

                $pages = Page::where('page_name', 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(6);
             }
        }
        

        // return $pages;

        return [
            'pagination' => [
                'total' => $pages->total(),
                'current_page' => $pages->currentPage(),
                'per_page' => $pages->perPage(),
                'last_page' => $pages->lastPage(),
                'from' => $pages->firstItem(),
                'to' => $pages->lastItem()
            ],
            'pages' => $pages
        ];



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;

        // $this->validate(request(),[
        //     'page_name' => 'required',
        //     'user_ftp' => 'required',
        //     'pass_ftp' => 'required',
        //     'link_file' => 'required',
        //     'current_code' => 'required',
        //   ]);

        try{
            DB::beginTransaction();
            $page = new Page();
            $page->page_name = $request->page_name;
            $page->user_ftp = $request->user_ftp;
            $page->pass_ftp = $request->pass_ftp;
            $page->link_file = $request->link_file;
            $page->current_code = $request->current_code;
            $page->save();


            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        // return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        // $this->authorize('update', $user);
        // $programados = $page->codes->where([['executed', '=', '0'], ['cron_date', '<', today()]])->get();
        // $pagina = Page::findOrFail($page->id);

        $programados = $page->codes->where('executed', '=', 0)
                                    // ->where('cron_date', '>=', today())
                                    ->all();

        // dd( $pagina);

        return response()->json([
            'page' => $page,
            'programados' => $programados
        ]);


        // return view('admin.pages.edit', compact('page', 'programados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page, Request $request)
    {
        // $this->authorize('update', $user);

        // return $request;

        // $this->validate(request(),[
        //     'page_name' => 'required',
        //     'user_ftp' => 'required',
        //     'pass_ftp' => 'required',
        //     'link_file' => 'required',
        //   ]);
        // return $request;

        $page->page_name = $request->page_name;
        $page->user_ftp = $request->user_ftp;
        $page->pass_ftp = $request->pass_ftp;
        $page->link_file = $request->link_file;
        $page->current_code = $request->current_code;

                    // $page->cron_update = $request->has('cron_update') ? Carbon::parse($request->cron_update) : null;
        $page->save();

        // return redirect()->route('admin.pages.edit', $page)->withFlash('Página actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
    }

    public function deactivate(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->active = '0';
        $page->save();
    }
    public function activate(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->active = '1';
        $page->save();
    }
}
