<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lihat {{$title}}</h3>
        </div>
        <img src="/storage/mading/{{$mading->foto}}" class="card-img-top" alt="Thumbnail Mading" style="height: 30vw">

        <!-- /.card-header -->
        <div class="card-body">
            <h3 class="card-title">{{$mading->judul}}</h3>
            <p class="card-text">{{$mading->informasi}}</p>
            <p><span class="fas fa-calendar" style="color:grey"></span> {{$mading->create_at}}</p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
