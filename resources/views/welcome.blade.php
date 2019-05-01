{{-- tinker/ add data --}}
$tips = new App\Tip
$tips->all();
$tips->name = 'John'
$tips->save();
exit();


{{-- session --}}
{{-- add to session --}}
session(['key' => 'john']);

{{-- retrive data --}}
return session('key');

{{-- forget data --}}
session()->forget('key');