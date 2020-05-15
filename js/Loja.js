var canvas = document.getElementById('canvas');
if (canvas.getContext && canvas.getContext('2d'))
var ctx = canvas.getContext('2d');
(function () {
    
    var baza = null;
    window.requestAnimFrame = (function() {
        return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function(callback) 
        {
            window.setTimeout(callback, 1000 / 60);
        };
    })();
    
    var Pamja = {
        hyrja: function() {
            this.text = 'Loja e Gjuajtjes';
            this.textSub = 'Trokit p\u00ebr t\u00eb filluar';
            this.textColor = 'black';
            this.krijo();
        },
        fundi: function() {
            this.text = 'Loja Mbaroi';
            this.textSub = 'Trokit p\u00ebr t\u00eb rifilluar';
            this.textColor = 'red';
            this.krijo();
        },
        krijo: function() {
            baza.fillStyle = 'black';
            baza.fillRect(0, 0, Loja.width, Loja.height);
            baza.fillStyle = this.textColor;
            baza.textAlign = 'center';
            baza.font = '35px helvetica, arial';
            baza.fillText(this.text, Loja.width / 2, Loja.height / 2);
            baza.fillStyle = 'black';
            baza.font = '12px helvetica, arial';
            baza.fillText(this.textSub, Loja.width / 2, Loja.height / 2 + 30);
        }
    };
    
    var Loja = {
        canvas: document.getElementById('canvas'),
        rregullimi: function() 
        {
            if (this.canvas.getContext)
            {
                baza = this.canvas.getContext('2d');
                this.width = this.canvas.width;
                this.height = this.canvas.height;
                Pamja.hyrja();
                this.canvas.addEventListener('click', this.fLoja, false);
                Kontrolli.filli();
            }
        },
        fLoja: function() {
            Loja.canvas.removeEventListener('click', Loja.fLoja, false);
            Loja.filli();
            Loja.animo();
        },
        rfLoja: function() {
            Loja.canvas.removeEventListener('click', Loja.rfLoja, false);
            Loja.filli();
        },
        animo: function() 
        {
            Loja.play = requestAnimFrame(Loja.animo);
            Loja.vizato();
        },
        filli: function() 
        {
            Prapaskena.filli();
            Pika.filli();
            Topi.filli();
            Shiriti.filli();
            Blloku.filli();
        },
        vizato: function() 
        {
            baza.clearRect(0, 0, this.width, this.height);
            Prapaskena.vizato();
            Blloku.vizato();
            Shiriti.vizato();
            Pika.vizato();
            Topi.vizato();
        },
        ecuria: function() {
            Pika.nv += 1;
            Blloku.filli();
            Topi.filli();
            Shiriti.filli();
        },
        kufiri_ecuria: function(lv) {
            return lv > 5 ? 5 : lv;
        }
    };
    
    var Pika = {
        filli: function() {
            this.nv = 1;
            this.rezultati = 0;
        },
         vizato: function() {
            baza.font = '12px helvetica, arial';
            baza.fillStyle = 'white';
            baza.textAlign = 'left';
            baza.fillText('Rezultati: ' + this.rezultati, 5, Loja.height - 5);
            baza.textAlign = 'right';
            baza.fillText('Nv: ' + this.nv, Loja.width - 5, Loja.height - 5);
        }
    };
    
    var Prapaskena = {
        filli: function() 
        {
            this.ready = false;
            this.img = new Image();
            this.img.src = 'http://www.toca-ch.com/data/walls/27/22105396.jpg';
            this.img.onload = function() 
            {
                Prapaskena.ready = true;
            };
        },
        vizato: function() 
        {
            if (this.ready) 
            {
                baza.drawImage(this.img, 0, 0);
            }
        }
    };
    
    var Blloku = {
        gap: 2,
        col: 5,
        w: 80,
        h: 15,
        filli: function() 
        {
            this.row = 2 + Loja.kufiri_ecuria(Pika.nv);
            this.total = 0;
            this.count = [this.row];
            for (var i = this.row; i--;)
            {
                this.count[i] = [this.col];
            }
        },
        vizato: function() 
        {
            var i, j;
            for (i = this.row; i--;) 
            {
                for (j = this.col; j--;) 
                {
                    if (this.count[i][j] !== false) 
                    {
                        if (Topi.x >= this.x(j) && Topi.x <= (this.x(j) + this.w) && Topi.y >= this.y(i) && Topi.y <= (this.y(i) + this.h))
                        {
                            this.perplasja(i, j);
                            continue;
                        }
                        baza.fillStyle = "#ff0000";
                        baza.fillRect(this.x(j), this.y(i), this.w, this.h);
                    }
                }
            }
            if (this.total === (this.row * this.col)) 
            {
                Loja.ecuria();
            }
        },
       
        perplasja: function(i, j) 
        {
            Pika.rezultati += 1;
            this.total += 1;
            this.count[i][j] = false;
            Topi.sy = -Topi.sy;
        },
        x: function(row) 
        {
            return (row * this.w) + (row * this.gap);
        },
        y: function(col)
        {
            return (col * this.h) + (col * this.gap);
        }
    };
   
    var Topi = {
        r: 10,
        filli: function() 
        {
            this.x = 120;
            this.y = 120;
            this.sx = 1 + (0.4 * Pika.nv);
            this.sy = -1.5 - (0.4 * Pika.nv);
        },
        vizato: function() 
        {
            this.kendet();
            this.perplasja();
            this.levizja();
            baza.beginPath();
            baza.arc(this.x, this.y, this.r, 0, 2 * Math.PI);
            baza.closePath();
            baza.fillStyle = 'black';
            baza.fill();
        },
        kendet: function() 
        {
            if (this.y < 1) 
            {
                this.y = 1;
                this.sy = -this.sy;
            } 
            else if (this.y > Loja.height)
            {
                this.sy = this.sx = 0;
                this.y = this.x = 1000;
                Pamja.fundi();
                canvas.addEventListener('click', Loja.rfLoja, false);
                return;
            }
            if (this.x < 1)
            {
                this.x = 1;
                this.sx = -this.sx;
            }
            else if (this.x > Loja.width)
            {
                this.x = Loja.width - 1;
                this.sx = -this.sx;
            }
        },
        perplasja: function()
        {
            if (this.x >= Shiriti.x && this.x <= (Shiriti.x + Shiriti.w) && this.y >= Shiriti.y && this.y <= (Shiriti.y + Shiriti.h)) 
            {
                this.sx = 7 * ((this.x - (Shiriti.x + Shiriti.w / 2)) / Shiriti.w);
                this.sy = -this.sy;
            }
        },
        levizja: function()
        {
            this.x += this.sx;
            this.y += this.sy;
        }
    };
    
    var Shiriti = {
        w: 90,
        h: 20,
        r: 9,
        filli: function() 
        {
            this.x = 100;
            this.y = 210;
            this.shpejtesia = 4;
        },
        vizato: function()
        {
            this.levize();
            baza.beginPath();
            baza.moveTo(this.x, this.y);
            baza.arcTo(this.x + this.w, this.y,
                this.x + this.w, this.y + this.r, this.r);
            baza.lineTo(this.x + this.w, this.y + this.h - this.r);
            baza.arcTo(this.x + this.w, this.y + this.h,
                this.x + this.w - this.r, this.y + this.h, this.r);
            baza.lineTo(this.x + this.r, this.y + this.h);
            baza.arcTo(this.x, this.y + this.h,
                this.x, this.y + this.h - this.r, this.r);
            baza.lineTo(this.x, this.y + this.r);
            baza.arcTo(this.x, this.y, this.x + this.r, this.y, this.r);
            baza.closePath();
            
            baza.fillStyle = this.gradient();
            baza.fill();
        },
        levize: function() 
        {
            if (Kontrolli.left && (this.x < Loja.width - (this.w / 2))) 
            {
                this.x += this.shpejtesia;
            } 
            else if (Kontrolli.right && this.x > -this.w / 2) 
            {
                this.x += -this.shpejtesia;
            }
        },
        gradient: function() 
        {
            if (this.gradientCache) 
            {
                return this.gradientCache;
            }
            this.gradientCache = baza.createLinearGradient(this.x, this.y, this.x, this.y + 20);
            this.gradientCache.addColorStop(0, '#eee');
            this.gradientCache.addColorStop(1, '#999');
            return this.gradientCache;
        }
    };
    
    var Kontrolli = {
        filli: function() 
        {
            window.addEventListener('keydown', this.shPoshte, true);
            window.addEventListener('keyup', this.shLart, true);
            window.addEventListener('mousemove', this. movePaddle, true);
            
            Loja.canvas.addEventListener('touchstart', this.movePaddle, false);
            Loja.canvas.addEventListener('touchmove', this.movePaddle, false);
            Loja.canvas.addEventListener('touchmove', this.stopTouchScroll, false);
        },
        shPoshte: function(event) 
        {
            switch(event.keyCode) 
            {
                case 39:
                Kontrolli.left = true;
                break;
                case 37:
                Kontrolli.right = true;
                break;
                default:
                break;
            }
        },
        shLart: function(event) 
        {
            switch(event.keyCode) 
            {
                case 39:
                Kontrolli.left = false;
                break;
                case 37:
                Kontrolli.right = false;
                break;
                default:
                break;
            }
        },
        movePaddle: function(event) 
        {
            var mouseX = event.pageX;
            var canvasX = Loja.canvas.offsetLeft;
            var paddleMid = Shiriti.w / 2;
            if (mouseX > canvasX && mouseX < canvasX + Loja.width) 
            {
            var newX = mouseX - canvasX;
            newX -= paddleMid;
            Shiriti.x = newX;
            }
        },
        stopTouchScroll: function(event) 
        {
            event.preventDefault();
        }
    };
    
    window.onload = function() {
        Loja.rregullimi();
    };
    }());