<!-- footer -->

<footer>
            <div class="footer_text">
                <b>OneComunity</b>
                <b>2022</b>
            </div>
        </footer>
    </div>

    <!-- javascript files -->
    <script src="./asset/js/jquery.min.js"></script>
    <!--dataTable-->
    <script src="./vendor/data-table/media/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
    <!-- bootstrap js -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            "use strict";
            $('.data-table').DataTable({});
        });

    </script>
    <!-- function like with ajax and comment-->
    <script>
        function like(user_id,blog_id,event){
            // catch the user id and blog id
            var old_like = $('.like_count_text_'+blog_id).text();
            var data = { 
                user_id : user_id,
                blog_id: blog_id,
            };
            // then setup ajax
            $.ajax({
                method: 'POST', // method post
                url: 'admin/functions/like.php', // post link means where will be data go
                data: data, // datas
                success: function(response){
                    if(response == 'Liked'){
                        $('#blogLike_'+blog_id).addClass('liked');
                        $('#blogLike_'+blog_id).removeClass('out-line-blue');
                        old_like++;
                        $('.like_count_text_'+blog_id).html(old_like);
                    }else{
                        $('#blogLike_'+blog_id).addClass('out-line-blue');
                        $('#blogLike_'+blog_id).removeClass('liked');
                        old_like--;
                        $('.like_count_text_'+blog_id).html(old_like);
                    }
                    
                },
                error: function (request, status, error) {
                    alert("There was an error: ", request.responseText);
                }
            })

        }

        function show_comment_area(blog_id){
            $('#blogComment_'+blog_id).toggleClass('show_comment');
        }
        
        function comment(user_id,blog_id){

            // get the comment text
            var comment = $('#comment_text'+blog_id).val();
            var old_like = $('.comment_count_text_'+blog_id).text();
            // // catch the user id and blog id
            var data = { 
                user_id : user_id,
                blog_id: blog_id,
                comment: comment,
            };
            // then setup ajax
            $.ajax({
                method: 'POST', // method post
                url: 'admin/functions/comment.php', // post comment means where will be data go
                data: data, // datas
                success: function(response){
                    var result = response.split('_');
                    $("<div class='comment_item'><div class='comments d-flex'><div class='commnet_user me-3'><img src='uploads/"+result['1']+"' width='45px'></div><div class='comment_text'><b>"+ result['0'] +"</b><p>"+result['2'] +"</p></div></div></div>").prependTo($('#commnet_form_'+blog_id));
                    $('#comment_text'+blog_id).val('');
                    old_like++;
                    $('.comment_count_text_'+blog_id).html(old_like);
                },
                error: function (request, status, error) {
                    alert("There was an error: ", request.responseText);
                }
            })
            
        }

        // comment replay
        function comment_replay_area(comment_id){
            $('#replay_area_'+comment_id).toggleClass('show_comment');
        }

        function comment_replay(user_id,comment_id){

            // get the comment text
            var replay = $('#replay_text'+comment_id).val();
            // // catch the user id and blog id
            var data = { 
                user_id : user_id,
                comment_id: comment_id,
                replay: replay,
            };
            // then setup ajax
            $.ajax({
                method: 'POST', // method post
                url: 'admin/functions/comment_replay.php', // post comment means where will be data go
                data: data, // datas
                success: function(response){
                    var result = response.split('_');
                    $("<div class='replay_comments d-flex'><div class='commnet_user me-3'><img src='uploads/"+result['1']+"' width='45px'></div><div class='comment_text'><b>"+ result['0'] +"</b><p>"+result['2'] +"</p></div></div>").appendTo($('#comment_ID'+comment_id));
                    $('#replay_text'+comment_id).val('');
                },
                error: function (request, status, error) {
                    alert("There was an error: ", request.responseText);
                }
            })
            

        }
    </script>

</body>

</html>

