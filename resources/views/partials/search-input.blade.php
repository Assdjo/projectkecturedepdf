<input
class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
type="text" name="search" placeholder="search" value="{{ old('search', isset($_GET['search'])?$_GET['search']:'') }}" />
<button class="bg-blue-800 px-4 mx-5 rounded-lg  ">Recherchez</button>