/* Value Labels Plugin for flot.
 * Homepage:
 * http://sites.google.com/site/petrsstuff/projects/flotvallab
 *
 * Released under the MIT license by Petr Blahos, December 2009.
 *
 */
(function ($) {
    var options = {
        valueLabels: {
	    show: false,
	    escala: "",
	    imagenes: null,
	    doble: false,
	    soloimg: false,
	    graficaimg: "",
	    estilo: "flotvaluelabels",
	    hack : false
        }
    };
    
    function init(plot) {
        plot.hooks.draw.push(function (plot, ctx) {
	    if (!plot.getOptions().valueLabels.show) {
	        return
	    }
	    datos = plot.getData();
	    $.each(plot.getData(), function(ii, series) {
		    plot.getPlaceholder().find("#valueLabels"+ii).remove();
		    var html = '<div id="valueLabels' + ii + '" class="valueLabels">';
		    var last_x = -1000;
		    var last_y = -1000;
		    img = plot.getOptions().valueLabels.imagenes;
		    var estilo = plot.getOptions().valueLabels.estilo;
		    var grafica_imagen = plot.getOptions().valueLabels.graficaimg;
		    var hack = plot.getOptions().valueLabels.hack;
		    for (var i = 0; i < series.data.length; ++i) {
			if (series.data[i] == null)
			    continue;
			  
			var x = series.data[i][0], y = series.data[i][1];
			if (x < series.xaxis.min || x > series.xaxis.max || y < series.yaxis.min || y > series.yaxis.max)
			    continue;
			var val = y;
			if (series.valueLabelFunc) {
				val = series.valueLabelFunc({ series: series, seriesIndex: ii, index: i });
			}
			val = ""+val;
					var xx = series.xaxis.p2c(x)+plot.getPlotOffset().left;
					var yy = series.yaxis.p2c(y)-12+plot.getPlotOffset().top;

						var imagen = "";
						if (img != null && (grafica_imagen == series.label || grafica_imagen == ""))
						{
							
							if (!plot.getOptions().valueLabels.soloimg)
							{
								if (i == 0) 
								{
									xx = xx + 1;
								}
								else if(i == (series.data.length - 1))
								{
									xx = xx - 32;
								}
								else
								{
									xx = xx - 12;
								}
								
								if (yy < 40) 
								{
									yy = yy + 30;
								}
								else
								{						
									yy = yy - 37;
								}
							}
							else
							{
								if (i == 0) 
								{
									xx = xx + 1;
								}
								else if(i == (series.data.length - 1))
								{
									xx = xx - 13;
								}
								else
								{
									xx = xx - 12;
								}
								
								if (yy < 40) 
								{
									yy = yy + 17;
								}
								else
								{						
									yy = yy - 10;
								}
							}
							
							if (img[x] != null)
							{
								if(img[x][0] != "" && img[x][1] != "")
								{
									imagen = "<li><img class='fix_png " + estilo + "' src='" + img[x][0] + "'/><img class='fix_png marginleft1px " + estilo + "' src='" + img[x][1] + "'/></li>";
								}
								else if (img[x][0] != "")
								{
									imagen = "<li><img class='fix_png marginright2px " + estilo + "' src='" + img[x][0]+ "'/></li>";
								}
								else if (img[x][1] != "")
								{
									imagen = "<li><img class='fix_png marginright2px " + estilo + "' src='" + img[x][1]+ "'/></li>";
								}	
							}
					    }
						else
						{
							if (i == 0) 
							{
								xx = xx + 1;
							}
							else if(i == (series.data.length - 1))
							{
								xx = xx - 15;
							}
							else
							{
								xx = xx - 12;
							}
							
							if(ii > 0 && !hack)
							{
								if (yy < 50) 
								{
									yy = yy + 16;
								}
								else
								{						
									yy = yy - 8;
								}
							}
							else
							{
								if (yy < 26) 
								{
									yy = yy + 16;
								}
								else
								{						
									yy = yy - 8;
								}
							}
						}
						var head = '<div style="text-align:center;left:' + xx + 'px;top:' + yy + 'px;" class="valueLabel';
						if(val == "undefined")
						{
							val = "";
						}
						if (!plot.getOptions().valueLabels.soloimg)
						{
							if(imagen != null && imagen != "" && (val == null || val == ""))
							{
								var tail = '"><ul class="lista_sin_estilo">' + imagen + '</ul></div>';
							}
							else if(val != null && val != "" && (imagen == null || imagen == ""))
							{
								var tail = '"><ul class="lista_sin_estilo"><li>' + val + plot.getOptions().valueLabels.escala + '</li></ul></div>';
							}
							else
							{
								var tail = '"><ul class="lista_sin_estilo">' + imagen + '<li>' + val + plot.getOptions().valueLabels.escala + '</li></ul></div>';
							}
							
						}
						else
						{
							if(imagen != null && imagen != "")
							{
								var tail = '"><ul class="lista_sin_estilo">' + imagen + '<li></ul></div>';
								
							}
						}
						if (tail != null && tail != "")
						{
							html+= head + tail;
						}
						tail = "";
					/*}*/

		    }
		    html+= "</div>";
		    plot.getPlaceholder().append(html);
		});
        });
    }
    
    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'valueLabels',
        version: '1.0'
    });
})(jQuery);

