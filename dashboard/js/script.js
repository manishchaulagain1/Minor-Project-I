    $(function(){
        function stripTrailingSlash(str) {
            if(str.substr(-1) == '/') {
              return str.substr(0, str.length - 1);
            }
            return str;
        }

        var url = window.location.pathname;  
        var activePage = stripTrailingSlash(url);

        $('.nav li a').each(function(){  
            var currentPage = stripTrailingSlash($(this).attr('href'));

            if (activePage == currentPage) {
                $(this).parent().addClass('active'); 
            } 
        });
    });

    $(document).ready(function () {
        $('.deletebtn').click(function (e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('.delete_user_id').val(user_id);
            $('#DeleteModal').modal('show');
        });
    });

    $(document).ready(function () {
        $('.deletebtn').click(function (e) {
            e.preventDefault();

            var event_id = $(this).val();
            console.log(event_id);
            $('.delete_user_id').val(event_id);
            $('#DeleteModal').modal('show');
        });
    });

    $(document).ready(function () {
        $('.deletebtn').click(function (e) {
            e.preventDefault();

            var feedback_id = $(this).val();
            //console.log(user_id);
            $('.delete_feedback_id').val(feedback_id);
            $('#DeleteModal').modal('show');
        });
    });

    $(document).ready(function () {
        $('.approvebtn').click(function (e) {
            e.preventDefault();

            var event_id = $(this).val();
            //console.log(user_id);
            $('.approveStatus_id').val(event_id);
            $('#ApproveModal').modal('show');
        });
    });

    $(document).ready(function () {
        $('.denybtn').click(function (e) {
            e.preventDefault();

            var event_id = $(this).val();
            //console.log(user_id);
            $('.denyStatus_id').val(event_id);
            $('#DenyModal').modal('show');
        });
    });