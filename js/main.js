// Ansuman Mishra(Ansuman.tech)

// ░█████╗░███╗░░██╗░██████╗██╗░░░██╗███╗░░░███╗░█████╗░███╗░░██╗  ███╗░░░███╗██╗░██████╗██╗░░██╗██████╗░░█████╗░
// ██╔══██╗████╗░██║██╔════╝██║░░░██║████╗░████║██╔══██╗████╗░██║  ████╗░████║██║██╔════╝██║░░██║██╔══██╗██╔══██╗
// ███████║██╔██╗██║╚█████╗░██║░░░██║██╔████╔██║███████║██╔██╗██║  ██╔████╔██║██║╚█████╗░███████║██████╔╝███████║
// ██╔══██║██║╚████║░╚═══██╗██║░░░██║██║╚██╔╝██║██╔══██║██║╚████║  ██║╚██╔╝██║██║░╚═══██╗██╔══██║██╔══██╗██╔══██║
// ██║░░██║██║░╚███║██████╔╝╚██████╔╝██║░╚═╝░██║██║░░██║██║░╚███║  ██║░╚═╝░██║██║██████╔╝██║░░██║██║░░██║██║░░██║
// ╚═╝░░╚═╝╚═╝░░╚══╝╚═════╝░░╚═════╝░╚═╝░░░░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝  ╚═╝░░░░░╚═╝╚═╝╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝

// 𝘞𝘢𝘳𝘯𝘪𝘯𝘨:𝘠𝘰𝘶 𝘊𝘢𝘯 𝘙𝘦𝘱𝘭𝘪𝘤𝘢𝘵𝘦 𝘛𝘩𝘦 𝘜𝘐 𝘉𝘶𝘵 𝘋𝘰 𝘕𝘖𝘛 𝘵𝘳𝘺 𝘵𝘰 𝘊𝘰𝘱𝘺 𝘛𝘩𝘦 𝘊𝘰𝘯𝘵𝘦𝘯𝘵 𝘈𝘯𝘥 𝘛𝘩𝘦 𝘗𝘦𝘳𝘴𝘰𝘯𝘢𝘭 𝘋𝘦𝘵𝘢𝘪𝘭𝘴.
// 𝘚𝘰𝘶𝘳𝘤𝘦𝘊𝘰𝘥𝘦 𝘈𝘷𝘢𝘪𝘭𝘢𝘣𝘭𝘦@ 𝘩𝘵𝘵𝘱𝘴://𝘨𝘪𝘵𝘩𝘶𝘣.𝘤𝘰𝘮/𝘢𝘯𝘴𝘮𝘪𝘴-𝘭𝘪𝘵/𝘢𝘯𝘴𝘮𝘪𝘴-𝘭𝘪𝘵.𝘨𝘪𝘵𝘩𝘶𝘣.𝘪𝘰

function menuToggle(){
	document.getElementById("checkMenu").checked=false;
}
/****** Scroll Reveal ********
 Function 'reveal' */
window.addEventListener('scroll', reveal);

    function reveal(){
      var reveals = document.querySelectorAll('.reveal');

      for(var i = 0; i < reveals.length; i++){

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 1;

        if(revealtop < windowheight - revealpoint){
          reveals[i].classList.add('active');
        }
        else{
          reveals[i].classList.remove('active');
        }
      }
    }
document.getElementById("sendForm").addEventListener("submit",function(){
  alert("Your Response Recorded Successfully");

});