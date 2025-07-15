<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Request $request,User $user)
    {
        $user = User::findOrFail($user->id);
        return view('users.show',compact('user'));
    }
    public function search(Request $request)
    {
        $search=$request->search;
        $users=User::where('name','like','%'.$search.'%')->orwhere('email','like','%'.$search.'%')->get();
        return view('users.index',compact('users'));

    }
    public function search_user(Request $request)
    {
        $search_user = $request->search_user;
        $users = User::withTrashed()
            ->where('name', 'like', "%{$search_user}%")
            ->orWhere('email', 'like', "%{$search_user}%")
            ->get();
        return view('users.archived', compact('users'));
    }
     public function archived(Request $request)
    {
        $users = User::onlyTrashed()->get();
        return view('users.archived', compact('users'));
    }
     public function restore(Request $request,User $user)
    {

        $user->restore();
        return redirect('/users/index');
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image');

        $image_store = new ImageController;
        $img_dtls = $image_store->store($image);
        $img_path = $img_dtls['image'];
        $user = new User();
        $user->name = $request->name;
        $user->email= $request->email;
        $user->password = $request->password;
        $user->img_path =$img_path;



        $user->save();

        return redirect()->route('users.index')->with('success', 'user created successfully!');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,User $user)
    {

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role' => 'required|string|max:255',
            ]);

            $user->update($validated);

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        $user_dtl = DB::table('users')->where('id', $user)->first();
// dd($user_dtl);
    if (!$user_dtl) {
        return redirect()->back()->with('error', 'User not found');
    }

    if ($user_dtl->deleted_at) {
        // Hard delete if trashed
        DB::table('users')->where('id', $user)->delete();
        $message = 'User permanently deleted successfully';
    } else {
        // Soft delete if active
        $active_user=User::where('id', $user)->first();
        $active_user->delete();
        $message = 'User soft deleted successfully';
    }

     return redirect()->route('users.index')->with('success', 'user deleted successfully!');
}
}
