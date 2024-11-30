@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Cabecalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex gap-3 align-items-center">
                    <a href="/home"><i class="bi bi-arrow-left"></i></a>
                    </a>
                    <h4 class="mb-0">Detalhes da Sala</h4>
                </div>
                <div class="d-flex gap-2">
                    <img src="{{ auth()->user()->userPicture }}" class="rounded-circle" width="50" height="50" alt="Profile">
                </div>
            </div>
            <!-- Detalhes da sala -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="card-title">{{$TheRoomById->name}}</h3>
                            <p class="text-muted mb-2">{{$TheRoomById->local}}</p>
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge bg-success">Disponível</span>
                                <span class="badge bg-primary">
                                    <i class="bi bi-people-fill me-1"></i>
                                    Capacidade: @if ($peopleOnTheRoom)
                                    {{count($peopleOnTheRoom)}}
                                    @else 0
                                    @endif /{{$TheRoomById->maxCapacity}}
                                </span>
                            </div>
                        </div>

                        @if (count($Roomfn) > 0)
                            @php
                                $userReservation = $Roomfn->firstWhere('user_id', auth()->user()->id);
                            @endphp

                            @if ($userReservation)
                                <a href="{{ route('disreserve-room', ['id' => $userReservation->id]) }}">
                                    <button class="btn btn-danger">Sair desta Sala</button>
                                </a>
                            @else
                                <a href="{{ route('reserve-room', ['room_id' => $TheRoomById->id, 'user_id' => auth()->user()->id]) }}">
                                    <button class="btn btn-primary">Reservar Sala</button>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('reserve-room', ['room_id' => $TheRoomById->id, 'user_id' => auth()->user()->id]) }}">
                                <button class="btn btn-primary">Reservar Sala</button>
                            </a>
                        @endif

                    </div>

                    @if (session('message'))
                        <div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!--Fotos da sala -->
                    <div class="mb-4">
                        <h5 class="mb-3">Fotos da Sala</h5>
                        <div class="row g-2">
                            @if ($RoomPictures[0] != '')
                            @foreach ($RoomPictures as $RoomPicture)
                            <div class="col-4">
                                <img src="{{$RoomPicture}}" class="img-fluid rounded" alt="pictures">
                            </div>
                            @endforeach
                            @else
                            <strong>Nenhuma foto disponivel para está sala!</strong>
                            @endif
                        </div>
                    </div>

                    <!-- Utilidades da sala -->
                    <div class="mb-4">
                        <h5 class="mb-3">Recursos Disponíveis</h5>
                        <div class="row g-3">
                            @if ($RoomUtils[0] != '')
                            @foreach ($RoomUtils as $RoomUtil )
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-tv fs-5"></i>
                                    <span>{{$RoomUtil}}</span>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <strong>Nenhum Recursos Disponíveis nestá sala!</strong>
                            @endif
                        </div>
                    </div>

                    <!-- PEssoas na sala -->
                    <div class="mb-4">
                        <h5 class="mb-3">Pessoas na Sala</h5>
                        <div class="d-flex flex-wrap gap-3">
                            @if ($peopleOnTheRoom)
                                @foreach ($peopleOnTheRoom as $peoples)
                                    @foreach ($peoples as $people)

                                    <div class="text-center">
                                        <img src="{{$people->userPicture}}" class="rounded-circle mb-1" width="40" height="40" alt="Usuário {{ $people->id }}">
                                        <small class="d-block text-muted">{{ $people->name }}</small>
                                    </div>
                                    @endforeach
                                @endforeach
                            @else
                            <strong>Nenhuma pessoa nestá sala!</strong>
                            @endif
                        </div>
                    </div>

                    <!-- Agenda da Sala -->
                    <div>
                        <h5 class="mb-3">Agenda de Hoje para {{$TheRoomById->name}}</h5>
                        <div class="list-group">
                            @foreach ($RoomSchedules as $RoomSchedule)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <div style="margin-right: 12px;">
                                            @if ($RoomFnSchedules->isNotEmpty())
                                                @php
                                                    $userTasking = $RoomFnSchedules->first(function ($schedule) use ($RoomSchedule) {
                                                        return $schedule->user_id === auth()->user()->id && $schedule->schedule_id === $RoomSchedule->id;
                                                    });
                                                @endphp

                                                @if ($userTasking)
                                                    <a href="{{ route('disreserve-task', ['id' => $userTasking->id]) }}">
                                                        <button class="btn btn-danger">Sair desta reunião</button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('reserve-task', ['room_id' => $TheRoomById->id, 'schedule_id' => $RoomSchedule->id, 'user_id' => auth()->user()->id]) }}">
                                                        <button class="btn btn-primary">Entrar na reunião</button>
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('reserve-task', ['room_id' => $TheRoomById->id, 'schedule_id' => $RoomSchedule->id, 'user_id' => auth()->user()->id]) }}">
                                                    <button class="btn btn-primary">Entrar na reunião</button>
                                                </a>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{$RoomSchedule->title}}</h6>
                                            <small class="text-muted">{{$RoomSchedule->date}}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-group">
                                            @foreach ($RoomFnSchedules as $RoomFnSchedule)
                                                @if ($RoomSchedule->id == $RoomFnSchedule->schedule_id)
                                                    @if ($peopleOnTheRoom)
                                                        @foreach ($peopleOnTheRoom as $peoples)
                                                            @foreach ($peoples as $people)
                                                                @if($RoomFnSchedule->user_id == $people->id)
                                                                <img src="{{$people->userPicture}}" class="rounded-circle" width="30" height="30" alt="{{$people->name}}">
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @else
                                                        <strong>Ninguem marcado nestá reunião!</strong>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-group {
        display: flex;
    }

    .avatar-group img {
        margin-left: -10px;
        border: 2px solid #fff;
    }

    .avatar-group img:first-child {
        margin-left: 0;
    }

    .badge {
        font-weight: normal;
        padding: 0.5em 0.8em;
    }

    .list-group-item {
        padding: 1rem;
    }
</style>
@endpush