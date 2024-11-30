@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex gap-3">
                    <button class="btn btn-light"><i class="bi bi-list"></i></button>
                    <h4 class="mb-0">Eventos de Salas Hoje</h4>
                    <button class="btn btn-light"><i class="bi bi-geo-alt"></i></button>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-light"><i class="bi bi-bell"></i></button>
                    <img src="{{ auth()->user()->userPicture }}" class="rounded-circle" width="50" height="50" alt="Profile">
                </div>
            </div>
            
            <div class="card shadow-sm p-3">
                <h4>Filtrar Salas</h4>
                <form action="{{ route('rooms.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Data -->
                        <div class="col-md-4">
                            <label for="date" class="form-label">Data</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                        </div>
                        <!-- Horário de Início -->
                        <div class="col-md-4">
                            <label for="start_time" class="form-label">Horário de Início</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ request('start_time') }}">
                        </div>
                        <!-- Horário de Fim -->
                        <div class="col-md-4">
                            <label for="end_time" class="form-label">Horário de Fim</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ request('end_time') }}">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                    </div>
                </form>
            </div>



            @if ($AllRooms->isEmpty())
            <p class="text-muted">Nenhuma sala encontrada para os critérios informados.</p>
            @else
                <!-- Lista de Eventos -->
                <div class="card shadow-sm">
                    <div class="list-group list-group-flush">
                        <!-- Organização de Salas -->
                        <div class="list-group-item p-3">
                            <div class="d-flex gap-3">
                                <i class="fa fa-sitemap fa-2x"></i>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Organização de Salas</h5>
                                    <!-- <small class="text-muted">9AM</small> -->
                                </div>
                            </div>
                        </div>
                        @foreach ($AllRooms as $AllRoom)
                            <div class="card shadow-sm m-1">
                                <div class="d-flex">
                                    <div class="card d-flex m-2" style="width: 8rem;">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$AllRoom->dateStart}}</h6>
                                            <p class="card-title">Até</p>
                                            <h6 class="card-subtitle mb-2 text-muted">{{$AllRoom->dateEnd}}</h6>
                                        </div>
                                    </div>
                                    <!-- Revisão de Conteúdo -->
                                    <div class="group-item p-3">
                                        <div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-auto">
                                                    <!-- <strong class="d-block">18</strong>
                                                                <small class="text-muted">Dez</small> -->
                                                </div>
                                                <h5 class="mb-0">{{$AllRoom->name}}</h5> <!--  NOME DA SALA -->
                                                <div class="ms-auto">
                                                    <!-- <img src="user1.jpg" class="rounded-circle" width="30" height="30" alt="User"> -->
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <span class="badge bg-light text-dark">{{$AllRoom->local}}</span> <!-- localizacao -->
                                                </div>
                                                <div>
                                                    <span class="badge bg-light text-dark">{{$AllRoom->description}}</span> <!-- descricao -->
                                                </div>
                                                <div>   

                                                </div>
                                            </div>
                                            <small class="text-muted">{{$AllRoom->maxCapacity}} Pessoas</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h1></h1>
                                    </div>
                                </div>
                                <a class="btn btn-sm text-light" href="{{route('view-room', ['id' => $AllRoom->id])}}"> <button type="button" class="btn btn-dark m-1" style="width: 100%;">Veja Mais...</button></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif




        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<style>
    .avatar-group img {
        margin-left: -15px;
        border: 2px solid #fff;
    }

    .badge {
        font-weight: normal;
    }
</style>
@endpush


<script>
    $(document).ready(function() {
        $('#roomsTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>