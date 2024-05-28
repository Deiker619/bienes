<div>
    <div class="card">
        <div class="card-body">
            <div class="card-title font-weight-medium"> Historial de retiros </div>

            @if(count($retiros))
            @foreach($retiros as $retiro)
            <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between">
                <div class="pt-2">
                    <h5 class="mb-0">Retiro #{{$retiro->id}}</h5>
                    <p class="mb-0 text-muted">Entregado a: <span class="text-danger">{{$retiro->coordinacion->name_coordinacion}}</span></p>
                    <h5 class="mb-0 text-success">{{$retiro->cantidad_retirada}} {{$retiro->artificio->name}} <small class="text-warning">{{$retiro->created_at}}</small></h5>
                </div>
            </div>
            @endforeach
            @else
            <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between">
                <div class="pt-2">
                    <h5 class="mb-0">No se encontraron resultados</h5>
                </div>
            </div>


            @endif


            <a class="text-black mt-3 d-block font-weight-medium h6" href="{{route('retiro_ver')}}">View all <i class="mdi mdi-chevron-right"></i></a>
        </div>
    </div>
</div>