function showQRCode(c){var a=document.createElement("canvas"),b=a.getContext("2d");try{var d=new QRCode(10,QRErrorCorrectLevel.L);d.addData(c);d.make()}catch(g){return a=document.createElement("p"),b=document.createTextNode("QR Code FAIL! "+g),a.appendChild(b),a}c=d.getModuleCount();a.setAttribute("height",4*c+10);a.setAttribute("width",4*c+10);if(a.getContext)for(var e=0;e<c;e++)for(var f=0;f<c;f++)d.isDark(e,f)?b.fillStyle="rgb(0,0,0)":b.fillStyle="rgb(255,255,255)",b.fillRect(4*f+5,4*e+5,4,4);
b=document.createElement("img");b.src=a.toDataURL("image/png");return b};