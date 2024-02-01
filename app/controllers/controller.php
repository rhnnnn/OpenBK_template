<!-- use Illuminate\Support\Facades\Storage; -->

public function updateProfileImage(Request $request) {
    $user = Auth::user();

    if ($request->hasFile('photo')) {
        // Get the uploaded file from the request
        $file = $request->file('photo');

        // Validate the uploaded file
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Remove the old profile image if it exists
        if ($user->photo) {
            Storage::disk('public')->delete('profile_images/' . basename($user->photo));
        }

        // Store the new file in the 'public/profile_images' directory
        $path = $file->store('profile_images', 'public');

        // Remove the 'public/' prefix from the file path
        $path = str_replace('public/', '', $path);

        // Create a full path including the 'storage/' prefix
        $path = '/storage/' . $path;

        // Update the user's profile image field in the database
        $user->photo = $path;
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile image updated successfully!');
    } else {
        // Redirect back with an error message if no image file was uploaded
        return redirect()->back()->with('error', 'No image file was uploaded!');
    }
}
