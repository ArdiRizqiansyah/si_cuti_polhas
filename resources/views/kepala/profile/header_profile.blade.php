<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="{{ route('kepala.profile') }}" class="nav-link {{ request()->routeIs('kepala.profile') ? 'active' : '' }}" role="tab">Data Pribadi</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('kepala.profile.keluarga') }}" class="nav-link {{ request()->routeIs('kepala.profile.keluarga') ? 'active' : '' }}" role="tab">Data Keluarga</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('kepala.profile.akun') }}" class="nav-link {{ request()->routeIs('kepala.profile.akun') ? 'active' : '' }}" role="tab">Data Akun</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('kepala.profile.pegawai') }}" class="nav-link {{ request()->routeIs('kepala.profile.pegawai') ? 'active' : '' }}" role="tab">Data Pegawai</a>
            </li>
        </ul>
    </div>
</div>