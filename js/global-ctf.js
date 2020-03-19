 $(document).ready(function()
     {
            $(".home-ranking-top-hackers").hide();
            $(".home-ranking-top-teamhackers").hide();
            $(".home-challenges").hide();

        $(".ctf-challenge").click(function()
        {
            $(".home-user-profile").hide();
            $(".home-ranking-top-hackers").hide();
            $(".home-ranking-top-teamhackers").hide();
            $(".home-challenges").show();
        });

         

          $(".ctf-top-hackers").click(function()
        {
            $(".home-user-profile").hide();
            $(".home-ranking-top-hackers").show();
            $(".home-ranking-top-teamhackers").hide();
            $(".home-challenges").hide();
        });

		$(".ctf-top-teams").click(function()
        {
            $(".home-user-profile").hide();
            $(".home-ranking-top-hackers").hide();
            $(".home-ranking-top-teamhackers").show();
            $(".home-challenges").hide();
        });	

           $(".ctf-home").click(function()
        {
            $(".home-user-profile").show();
            $(".home-ranking-top-hackers").hide();
            $(".home-ranking-top-teamhackers").hide();
            $(".home-challenges").hide();
        });



       
    });   
