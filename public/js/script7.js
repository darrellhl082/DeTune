$('.search-key').on('keyup', function() {
    search($('.search-select').val());
});


function search(select) {
    var keyword = $('.search-key').val();
    $.post(`/search/` + select, {
            _token: $('meta[name="csrf-token"]').attr('content'),
            key: keyword,
            role: 'general'
        },
        function(data) {
            if (select == 'song') {
                $('.songs-field').show()
                $('.songs-field').html(data);
                $('.playlists-field').hide()
            } else {
                $('.playlists-field').show()
                resultPlaylist(data)
                $('.songs-field').hide()
            }

        });
}



function resultPlaylist(data) {
    let htmlView = '';

    if (data.playlist.length <= 0) {
        htmlView += `       
    <p>          
      No result found     
    </p>`;
    }

    data.playlist.forEach(e => {
        htmlView += `        
    <div class="col-md-3 mt-3">
              <div class="card" >
                  <div class="card-body">
                  <h5 class="card-title">` + e.name + `</h5>
                  <span class="card-subtitle mb-2 d-block text-muted">` + e.songs.length + ` Songs - Views ` + e.views+ `</span>
                    <span class="card-subtitle mb-2 d-block text-muted">Created By ` +e.user.username+ `</span>
                  <p class="card-text">` + e.desc + `</p>
              
                  <a href="/playlists/` + e.key + `" class="card-link text-decoration-none">
                      <span data-feather="eye"  style="width: 27px;height:27px"></span>
                  </a>
                     <span data-feather="share-2" class="btnshare" link="https://detune.my.id/playlists/` + e.key + `" style="width: 27px;height:27px"></span>
                  </a>
                  
                  </div>
              </div>
          </div>`;
    });
    $('.playlists-field').html(htmlView);
}



let key;
document.querySelectorAll('.edit').forEach(element => {
    element.addEventListener('click', function(e) {
        key = e.target.parentNode.parentNode.parentNode.getAttribute("name");
        document.querySelector(".e" + key).classList.toggle("d-none");
        document.getElementById(key).classList.toggle("d-none");
    })
});


$('li.playlist-list').click(function(e) {
    let form_name = e.target.getAttribute("data-song");
    $('.cat_id').val(e.target.getAttribute("name"));

    var form = $('#ss' + form_name);
    var inputs = form.find("input, select, button, textarea");
    var serializedData = form.serialize();

    request = $.ajax({
        url: "/addtoplaylist",
        type: "post",
        data: serializedData,
        success: function(data) {
            console.log(data)
            document.querySelector('.notif').innerHTML = "Added to Playlist";
            document.querySelector('.notif').classList.remove('d-none');
            setTimeout(() => {
                document.querySelector('.notif').style.opacity = 0;
                setTimeout(() => {
                    document.querySelector('.notif').classList.add('d-none');
                    document.querySelector('.notif').style.opacity = 0.9;
                }, 2000);
            }, 3000);
        }
    });

    request.done(function(response, textStatus, jqXHR) {


    });

})
$('.search-swap').hide()
$('.swap-s').click(function(e) {
    $('.swap-t').removeClass('swap-active');
    e.target.classList.add('swap-active');
    $('.search-swap').show()
    $('.list-swap').hide()
})

$('.swap-t').click(function(e) {
    $('.swap-s').removeClass('swap-active');
    e.target.classList.add('swap-active');
    $('.search-swap').hide()
    $('.list-swap').show()
})

$('.swap-search-key').on('keyup', function() {
    searchSwap();
});

function searchSwap() {
    var keyword = $('.swap-search-key').val();
    $.post(`/search/song`, {
            _token: $('meta[name="csrf-token"]').attr('content'),
            key: keyword,
            role: 'swap'
        },
        function(data) {

            $('.search-field').html(data);
            return;
        });
}


$('.loading').hide();

function showloading() {
    if ($('#inputsongs').val()) {
        $('.loading').show()
    }

}