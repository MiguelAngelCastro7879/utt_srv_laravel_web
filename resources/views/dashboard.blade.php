<x-app-layout>

    <div class="container">

        <p><a href="">
          The All-Star Store Servidor 1
        </a></p>

        <div class="image">
            <img src="images/logo.png">
        </div>

    </div>
    


</x-app-layout>

<style>
    .image{
        margin-left: 29em;
    }
    .color{
        color: #fff;
        font-size: 1.93em;
        margin-left: 23%;
        text-align: center;
    }
    @font-face {
  font-family: 'Monoton';
  font-style: normal;
  font-weight: 300;
  src: local('Monoton'), local('Monoton-Regular'), url(http://themes.googleusercontent.com/static/fonts/monoton/v4/AKI-lyzyNHXByGHeOcds_w.woff) format('woff');
}
/*neon effect*/
p{
  text-align:center;
  font-size:4em;
  margin:20px 0 20px 0;
}

a{
  text-decoration:none;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  transition: all 0.5s;
}

p:nth-child(1) a{
  color:#0d0061;
  font-family:Monoton;

  -webkit-animation: neon1 2s ease-in-out infinite alternate;
  -moz-animation: neon1 2s ease-in-out infinite alternate;
  animation: neon1 2s ease-in-out infinite alternate;
}
@-webkit-keyframes neon1 {
  from {
    text-shadow: 0 0 10px #5806aa,
               0 0 20px  #5806aa,
               0 0 30px  #5806aa,
               0 0 40px  #3111ff,
               0 0 70px  #5806aa,
               0 0 80px  #3111ff,
               0 0 100px #3111ff,
               0 0 150px #3111ff;
  }
  to {
    text-shadow: 0 0 5px #5806aa,
               0 0 10px #5806aa,
               0 0 15px #5806aa,
               0 0 20px #3111ff,
               0 0 35px #5806aa,
               0 0 40px #3111ff,
               0 0 50px #3111ff,
               0 0 75px #3111ff;
  }
}
@-moz-keyframes neon1 {
  from {
    text-shadow: 0 0 10px #5806aa,
               0 0 20px  #5806aa,
               0 0 30px  #5806aa,
               0 0 40px  #3111ff,
               0 0 70px  #5806aa,
               0 0 80px  #3111ff,
               0 0 100px #3111ff,
               0 0 150px #3111ff;
  }
  to {
    text-shadow: 0 0 5px #5806aa,
               0 0 10px #5806aa,
               0 0 15px #5806aa,
               0 0 20px #3111ff,
               0 0 35px #5806aa,
               0 0 40px #3111ff,
               0 0 50px #3111ff,
               0 0 75px #3111ff;
  }
}
@keyframes neon1 {
  from {
    text-shadow: 0 0 10px #5806aa,
               0 0 20px  #5806aa,
               0 0 30px  #5806aa,
               0 0 40px  #3111ff,
               0 0 70px  #5806aa,
               0 0 80px  #3111ff,
               0 0 100px #3111ff,
               0 0 150px #3111ff;
  }
  to {
    text-shadow: 0 0 5px #fff,
               0 0 10px #fff,
               0 0 15px #fff,
               0 0 20px #3111ff,
               0 0 35px #3111ff,
               0 0 40px #3111ff,
               0 0 50px #3111ff,
               0 0 75px #3111ff;
  }
}

</style>
