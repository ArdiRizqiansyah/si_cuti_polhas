<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.pegawai.edit.pribadi', ['id' => $profile->id]) }}" class="nav-link {{ request()->routeIs('admin.pegawai.edit.pribadi', ['id' => $profile->id]) ? 'active' : '' }}" role="tab">Data Pribadi</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.pegawai.edit.keluarga', ['id' => $profile->id]) }}" class="nav-link {{ request()->routeIs('admin.pegawai.edit.keluarga', ['id' => $profile->id]) ? 'active' : '' }}" role="tab">Data Keluarga</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.pegawai.edit.akun', ['id' => $profile->id]) }}" class="nav-link {{ request()->routeIs('admin.pegawai.edit.akun', ['id' => $profile->id]) ? 'active' : '' }}" role="tab">Data Akun</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.pegawai.edit.pegawai', ['id' => $profile->id]) }}" class="nav-link {{ request()->routeIs('admin.pegawai.edit.pegawai', ['id' => $profile->id]) ? 'active' : '' }}" role="tab">Data Pegawai</a>
            </li>
        </ul>
    </div>
</div>