<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lihat {{$title}}</h3>
        </div>
        <img src="/storage/mading/{{$mading->foto}}" class="card-img-top img-fluid" alt="Thumbnail Mading" style="height: 30vw; object-fit: cover">

        <!-- /.card-header -->
        <div class="card-body">
            <h3 class="card-title text-bold mb-3">{{$mading->judul}}</h3>
            <p class="card-text">{{$mading->informasi}}</p>
            <p><span class="fas fa-calendar mr-2" style="color:grey"></span> {{$mading->create_at}}</p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
