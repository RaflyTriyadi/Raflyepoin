<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Data Siswa</h1>
  <a href="{{ route('admin/dashboard') }}">Menu Utama</a><br>
  <a href="{{  route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  <br><br>
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>
  <br><br>
  <form action="" method="get">
    <label>Cari :</label>
    <input type="text" name="cari">
    <input type="submit" value="cari">
  </form>
  <br><br>
  <a href="{{ route('siswa.create') }}">Tambah Siswa</a>

  @if(Session::has('success'))
  <div class=" alert alret-success" role="alret">
    {{ Session::get('success') }}
  </div>
  @endif

  <table class="table">
    <tr>
      <th>Foto</th>
      <th>NIS</th>
      <th>Email</th>
      <th>Kelas</th>
      <th>No Hp</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
    @forelse ($siswas as $siswa)
    <tr>
      <td>
        <img src="{{ asset('storage/siswas/'.$siswa->image) }}" width="120px" height="120px" alt="">
      </td>
      <td>{{ $siswa->nis }}</td>
      <td>{{ $siswa->name }}</td>
      <td>{{ $siswa->email }}</td>
      <td>{{ $siswa->tingkatan }} {{ $siswa->kelas }}</td>
      <td>{{ $siswa->hp }}</td>
      @if ($siswa->status==1):
      <td>Aktif</td>
      @else
      <td>Tidak Aktif</td>
      @endif

  <td>
    <form onsubmit="return confirm('Apakah Anda Yakin?')" action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
      <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-sm btn-drak">SHOW</a>
      <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-primary">EDIT</a>
      @csrf
      @method('DELETE')
      <button type="submit">HAPUS</button>
    </form>
  </td>
</tr>
@empty
<tr>
      <td>
        <p>data tidak ditemukan</p>
      </td>
      <td>
        <a href="{{ route('siswa.index') }}">kembali</a>
      </td>
    </tr>
    @endforalse
</table>
    {{ $siswas->links() }}

</body>
</html>