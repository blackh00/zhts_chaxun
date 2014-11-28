(function(e, c, f) {
	var d = {
		init: function() {
			d.loaduse();
			d.loadtool();
			d.formInit();
			d.active();
			d.trackuse();
			d.add();
			d.del();
			d.clear();
			d._resize();
			d.citysug()
		},
		loaduse: function() {
			if (!e("#bd").hasClass("mybox")) {
				return
			}
			var h = a("user");
			if (!h || h.length == 0) {
				return
			}
			var k = null;
			e("#recent-use .items").empty();
			e("#recent-use .tool-type").append(e('<span class="clear">[清空]</span>'));
			for (var j = 0; j < h.length; j++) {
				k = e('<span class="item"/>');
				k.append(e("<h3 />").append(e("<b />").append(e('<a class="item-title" />').html(h[j].split("|")[0]).attr("href", h[j].split("|")[1]).attr("track", "link").attr("target", "_blank"))));
				k.appendTo(e("#recent-use .items"))
			}
			var l = e("#recent-use .items"),
			g = l.find(".item").length;
			l.find(".item").removeClass("nobd");
			for (var j = 0; j < g; j++) {
				if (((g % 5 != 0) && (g - j - 1 < g % 5)) || (g % 5 == 0 && g - j - 1 < 5)) {
					l.find(".item").eq(j).addClass("nobd")
				}
			}
		},
		loadtool: function() {
			if (!e("#bd").hasClass("mybox")) {
				return
			}
			var j = a("store"),
			o = "",
			n = "",
			h = [];
			if (!j || j.length == 0) {
				return
			}
			for (var l = 0; l < j.length; l++) {
				var k = e('<span class="item" />');
				o = j[l].split("|")[0];
				n = j[l].split("|")[1];
				k.append(e("<h3 />").append(e("<b />").append(e('<a class="item-title" />').html(o).attr("href", n).attr("track", "link").attr("target", "_blank")).append(e('<span class="del" />'))));
				h.push(k);
				k = null
			}
			var m = e("#mybox .items");
			for (var l = 0; l < h.length; l++) {
				h[l].appendTo(m)
			}
			var g = m.find(".item").length;
			m.find(".item").removeClass("nobd");
			e("#mybox .tool-type i").html("(" + m.find(".item").length + ")");
			for (var l = 0; l < g; l++) {
				if (((g % 5 != 0) && (g - l - 1 < g % 5)) || (g % 5 == 0 && g - l - 1 < 5)) {
					m.find(".item").eq(l).addClass("nobd")
				}
			}
		},
		formInit: function() {
			e("#train,#plane,#phonenum").submit(function(l) {
				if($("#startCity").val()=="出发地点"||$("#endCity").val()=="到达地点"){
					alert("请选择出发地或到达地");
					return false;
				}
				if (e(this).attr("status") == "off") {
					return false
				}
				var k = e(this),
				h = k.find('input[type="text"]'),
				g = h.length;
				for (var j = 0; j < h.length; j++) {
					if (e.trim(h.eq(j).val()) == "" || e.trim(h.eq(j).val()) == h.eq(j).attr("tipstxt")) {
						g = g - 1
					}
				}
				if (g > 0) {
					if (e(this).attr("accept-charset") == "utf-8") {
						c.document.charset = "utf-8";
						setTimeout(function() {
							c.document.charset = "gbk"
						},
						0)
					}
					for (var j = 0; j < h.length; j++) {
						if (e.trim(h.eq(j).val()) == h.eq(j).attr("tipstxt")) {
							h.eq(j).val("");
							h.eq(j).attr("fixed", "true")
						}
						setTimeout(function() {
							e('input[fixed="true"]').val(e('input[fixed="true"]').attr("tipstxt")).removeAttr("fixed")
						},
						0)
					}
				} else {
					if (k.attr("exaction")) {
						c.open(k.attr("exaction"))
					}
					l.preventDefault();
					return
				}
			});
			e.each(e("#query .query .key-l,#query .query .key-r"),
			function(h, g) {
				e(g).val(e(g).attr("tipstxt"));
				e(g).blur(function() {
					if (e.trim(e(this).val()) == "" || e.trim(e(this).val()) == e(this).attr("tipstxt")) {
						e(this).css("color", "#999");
						e(this).val(e(this).attr("tipstxt"))
					}
				}).focus(function() {
					if (e.trim(e(this).val()) == e(this).attr("tipstxt")) {
						e(this).val("");
						e(this).css("color", "#333")
					}
				})
			});
			e("#poster").submit(function() {
				var h = e(this),
				j = h.find('input[class="q-key"]').val(),
				g = "",
				k = null,
				i = null;
				if (isNaN(j)) {
					i = e('<input type="hidden" name="action" value="area2zone" />');
					g = "area";
					k = "gbk"
				} else {
					if (e.trim(j).length == 6) {
						i = e('<input type="hidden" name="action" value="zip2area" />');
						g = "zip"
					} else {
						if (e.trim(j) != "") {
							i = e('<input type="hidden" name="action" value="zone2area" />');
							g = "zone"
						} else {
							if (e.trim(j) == "") {
								return
							}
						}
					}
				}
				i.appendTo(h.find(".query"));
				h.find(".q-key").attr("name", g);
				if (k != null) {
					e(this).attr("accept-charset", "gbk")
				}
				setTimeout(function() {
					h.find(".q-key").removeAttr("name");
					i.remove();
					if (k != null) {
						h.attr("accept-charset", "utf-8")
					}
				},
				100)
			})
		},
		active: function() {
			e(".icon-tool .wrapper .icon-item").mouseenter(function() {
				e(this).addClass("cur")
			}).mouseleave(function() {
				e(this).removeClass("cur")
			});
			e(".icon-tool .wrapper .icon-item .add").mouseenter(function() {
				e(".icon-item").has(this).addClass("active")
			}).mouseleave(function() {
				e(".icon-item").has(this).removeClass("active")
			});
			e(".text-tools .items .item b").mouseenter(function() {
				e(".text-tools .items .item").has(this).addClass("cur")
			}).mouseleave(function() {
				e(".text-tools .items .item").has(this).removeClass("cur")
			})
		},
		trackuse: function() {
			var g = e('a[track="link"],input[track="link"]');
			g.click(function() {
				var n = e(this).html(),
				m = e(this).attr("href"),
				k = "";
				if (e(".icon-item").has(this).length != 0) {
					n = e(".icon-item").has(this).find(".item-title").html();
					m = e(".icon-item").has(this).find(".item-title").attr("href")
				}
				if (e("form").has(this).length != 0) {
					n = e("form").has(this).find(".item-title").html();
					m = e("form").has(this).find(".icon ").attr("href")
				}
				if (n && m) {
					k = n + "|" + m
				} else {
					return
				}
				var l = a("user") || [];
				for (var j = 0; j < l.length; j++) {
					if (l[j] == k) {
						l.splice(j, 1);
						break
					}
				}
				if (l.length >= 10) {
					l.pop()
				}
				try {
					l.unshift(k)
				} catch(h) {
					l = [];
					l.push(k)
				}
				b("user", l);
				if (l == a("user")) {
					return true
				}
			})
		},
		add: function() {
			var g = e(".text-tools,.icon-tool").find('span[class="add"]');
			g.click(function() {
				var n = e(this).siblings(".item-title");
				var h = [],
				m = n.html();
				link = n.attr("href"),
				tmp = "";
				if (m && link) {
					tmp = m + "|" + link
				} else {
					return
				}
				var j = null;
				if (e(".icon-item").has(this).length != 0) {
					j = e(".icon-item").has(this)
				} else {
					j = e(".item").has(this).find("b")
				}
				h = a("store") || [];
				for (var l = 0; l < h.length; l++) {
					if (h[l] == tmp) {
						d._showtips(j, "existed", "我的收藏中已有此应用");
						return
					}
				}
				try {
					h.push(tmp)
				} catch(k) {
					h = [];
					h.push(tmp)
				}
				b("store", h);
				if (h.join("-") == a("store").join("-")) {
					d._showtips(j, "succ", "成功添加到我的收藏")
				}
			})
		},
		del: function() {
			var g = e("#mybox .items .del");
			g.click(function() {
				var n = e(this).siblings(".item-title").html(),
				l = e(this).siblings(".item-title").attr("href"),
				k = n + "|" + l,
				m = a("store");
				for (var j = 0; j < m.length; j++) {
					if (m[j] == k) {
						m.splice(j, 1);
						break
					}
				}
				b("store", m);
				e(".item").has(this).remove();
				var h = e("#mybox").find(".item").length;
				e("#mybox").find(".item").removeClass("nobd");
				for (var j = 0; j < h; j++) {
					if (((h % 5 != 0) && (h - j - 1 < h % 5)) || (h % 5 == 0 && h - j - 1 < 5)) {
						e("#mybox").find(".item").eq(j).addClass("nobd")
					}
				}
				e("#mybox .tool-type i").html("(" + e("#mybox").find(".item").length + ")")
			})
		},
		clear: function() {
			e("#recent-use .clear").click(function() {
				e("#recent-use .items").empty();
				var g = [];
				var h = e('<div class="overlay"/>'),
				j = e(window).outerWidth(true),
				i = e(window).outerHeight(true);
				j = j < e("body").width() ? e("body").width() : j;
				i = i < e("body").height() ? e("body").height() : i;
				h.append(e('<div class="tipsoverlay" />').css({
					height: i,
					width: j
				})).append(e('<div class="cleartip" />').html('<span class="status"></span><span class="des">成功清空使用记录</span>')).appendTo(e("body"));
				h.find(".cleartip").css({
					left: (j - h.find(".cleartip").outerWidth()) / 2,
					top: (i - h.find(".cleartip").outerHeight()) / 2
				});
				h.find(".tipsoverlay").fadeIn(1000,
				function() {
					h.find(".cleartip").fadeIn("slow",
					function() {
						b("user", g);
						e("#recent-use .items").html('<a class="recent_empty" style="display: block;">暂无使用工具</a>');
						e("#recent-use .clear").remove();
						c.setTimeout(function() {
							h.find(".cleartip").fadeOut("slow",
							function() {
								h.find(".tipsoverlay").fadeOut("slow",
								function() {
									h.remove()
								})
							})
						},
						600)
					})
				})
			})
		},
		_showtips: function(l, k, h) {
			var l = l,
			k = k,
			h = h;
			var j = l.outerWidth(true),
			g = l.outerHeight(true),
			n = l.offset().left,
			m = l.offset().top;
			var i = e('<div class="tooltip" />');
			i.append(e('<span class="status" />')).append(e('<span class="des" />').html(h)).attr("id", k).appendTo(e("body")).css({
				left: n - i.outerWidth() / 2 + j / 2,
				top: m - i.outerHeight(),
				opacity: 0
			});
			i.animate({
				opacity: 1
			},
			"slow",
			function() {
				c.setTimeout(function() {
					e(i).fadeOut("slow",
					function() {
						e(i).remove()
					})
				},
				1000)
			})
		},
		_resize: function() {
			e(window).resize(function() {
				if (e(".overlay").length == 0) {
					return
				}
				g(window)
			});
			e(window).scroll(function() {
				if (e(".overlay").length == 0) {
					return
				}
				g(window)
			});
			function g(i) {
				var h = e(".overlay"),
				k = e(i).outerWidth(true),
				j = e(i).outerHeight(true);
				if (k < e("body").width()) {
					k = e("body").width()
				}
				if (j < e("body").height()) {
					j = e("body").height()
				}
				h.find(".tipsoverlay").css({
					height: j,
					width: k
				});
				h.find(".cleartip").css({
					left: (k - h.find(".cleartip").outerWidth()) / 2,
					top: (j - h.find(".cleartip").outerHeight()) / 2
				})
			}
		},
		citysug: function() {
			e("#query .query .q-access").click(function(m) {
				var j = e(this).prev("input"),
				n = null;
				var l = j.offset().left,
				k = j.offset().top,
				i = j.outerWidth(),
				h = j.outerHeight();
				n = e("#hotcity-sug-" + e("form").has(this).attr("id"));
				if (n.length == 0) {
					return
				}
				n.appendTo(e(".q-word").has(this)).css({
					top: h + 4
				}).slideDown("fast");
				e(".hotcity-sug").not(n).slideUp("fast");
				j.focus()
			});
			e(".hotcity-sug .tips i").click(function() {
				e(".hotcity-sug").has(this).slideUp("fast")
			});
			e(".hotcity-sug .sorttab a").mouseover(function() {
				var h = e(".hotcity-sug").has(this);
				if (e(".sorttab a", h).length == 1) {
					return
				}
				e(this).siblings("a").removeClass("cur");
				e(this).addClass("cur");
				h.find("ul").addClass("hidden");
				h.find('ul[tab="' + e(this).attr("tab") + '"]').removeClass("hidden")
			});
			e(".hotcity-sug .city li").mouseover(function() {
				e(this).siblings("li").removeClass("cur");
				e(this).addClass("cur")
			}).mouseout(function() {
				e(this).removeClass("cur")
			});
			e(".hotcity-sug .city li span").click(function() {
				var i = e(this).html(),
				h = e(".hotcity-sug").has(this).siblings("input");
				h.val(i).css("color", "#333");
				e(".hotcity-sug").has(this).slideUp("fast")
			});
			e("body").click(function(i) {
				var h = e(i.target || i.srcElement);
				if (!h.hasClass("q-access") && !h.hasClass("hotcity-sug") && e(".hotcity-sug").has(h).length == 0) {
					e(".hotcity-sug").slideUp("fast")
				}
				if (h.attr("id") != "city-sug" && e("#city-sug").has(h).length == 0) {
					e("#city-sug").slideUp("fast")
				}
			});
			e(".city-sug .q-key").keyup(function(q) {
				var t = e(this).val().toLowerCase(),
				n = [],
				o = [],
				s = [],
				r = [],
				k = null;
				if (e("form").has(this).attr("status") == "off") {
					return
				}
				if (q.keyCode == 38 || q.keyCode == 40) {
					return
				}
				if (e(".hotcity-sug").css("display") != "none") {
					e(".hotcity-sug").hide()
				}
				if (e.trim(t) == "") {
					e("#city-sug").hide();
					return
				}
				if (e("form").has(this).attr("id") == "train") {
					n = c.traincity.split(";")
				} else {
					n = c.flightcity.split(";")
				}
				if (n.length == 0 || e("#city-sug").length == 0) {
					return
				}
				for (var p = 0; p < n.length; p++) {
					o = n[p].split("|");
					for (var m = 0; m < o.length; m++) {
						if ((o[m].toLowerCase()).indexOf(t) == 0) {
							k = o[0];
							o[m] = o[m].replace(t, "<em>" + t + "</em>");
							if (m != 0) {
								s.push(k);
								s.push(o[0]);
								s.push(o[m])
							} else {
								s.push(k);
								s.push(o[m]);
								s.push(o[1])
							}
							r.push(s);
							s = [];
							break
						}
					}
					if (r.length == 10) {
						break
					}
				}
				var l = e("#city-sug"),
				h = "";
				if (r.length == 0) {
					l.html('<span class="notfound">对不起,不支持该城市</span>')
				} else {
					l.html("");
					for (var p = 0; p < r.length; p++) {
						if (p == 0) {
							h = "cur"
						} else {
							h = ""
						}
						e('<span class="cityname ' + h + '" city="' + r[p][0] + '"/>').append(e('<span class="name" />').html(r[p][1])).append(e('<span class="short-name" />').html("(" + r[p][2] + ")")).appendTo(l)
					}
				}
				l.css({
					left: 0,
					top: e(this).outerHeight()
				}).appendTo(e(".q-word").has(this)).slideDown("fast")
			});
			e(".city-sug .q-key").keydown(function(l) {
				var k = "",
				j = this,
				i = e(this).siblings("#city-sug");
				if (i.length == 0) {
					return
				}
				if (l.keyCode == 38 && i.find(".cityname").length > 1) {
					k = "up"
				} else {
					if (l.keyCode == 40 && i.find(".cityname").length > 1) {
						k = "down"
					} else {
						if (l.keyCode == 13 && e(".q-word").has(this).find("#city-sug").css("display") != "none" && i.find(".cityname").length >= 1) {
							k = "chose"
						} else {
							if (e(".q-word").has(this).find("#city-sug").length == 0 || e(".q-word").has(this).find("#city-sug").css("display") == "none") {
								return
							} else {
								return
							}
						}
					}
				}
				if (i.length == 0) {
					return
				}
				var h = i.find(".cur").eq(0);
				if (k == "up") {
					i.find(".cityname").removeClass("cur");
					if (h.prev("span").length == 0) {
						i.find(".cityname").last().addClass("cur")
					} else {
						h.prev("span").addClass("cur")
					}
					return
				}
				if (k == "down") {
					i.find(".cityname").removeClass("cur");
					if (h.next("span").length == 0) {
						i.find(".cityname").first().addClass("cur")
					} else {
						h.next("span").addClass("cur")
					}
					return
				}
				if (k == "chose") {
					e(this).val(h.attr("city")).css("color", "#333");
					e("#city-sug").hide();
					e("form").has(j).attr("status", "off");
					setTimeout(function() {
						e("form").has(j).attr("status", "on")
					},
					100)
				}
			});
			e("#city-sug .cityname").live("mouseover",
			function() {
				e(this).siblings("span").removeClass("cur");
				e(this).addClass("cur")
			});
			e("#city-sug .cityname").live("click",
			function() {
				var h = e(this).attr("city");
				e("#city-sug").siblings("input").val(h);
				e("#city-sug").slideUp("fast")
			});
			function g(j, h) {
				var m = j,
				i = h,
				l = i.offset().left,
				k = i.offset().top + i.outerHeight();
				m.css({
					left: l,
					top: k
				})
			}
		}
	};
	function b(h, i) {
		var j = null,
		i = i;
		if (typeof i != "string" && i) {
			i = baidu.json.stringify(i)
		}
		if (typeof localStorage != "undefined") {
			j = localStorage;
			j.setItem(h, escape(i));
			return
		}
		if (typeof localStorage != "undefined") {
			try {
				j = localStorage;
				j.setItem(h, escape(i));
				if (i == a(h)) {
					alert("添加成功")
				} else {
					alert("添加失败")
				}
			} catch(g) {
				alert(g)
			}
		} else {
			if (c._infoaccessready) {
				e(c.frames.userframe.window)[0]._setInfo(h, i)
			} else {
				c.intervl = setInterval(function() {
					if (c._infoaccessready) {
						e(c.frames.userframe.window)[0]._setInfo(h, i);
						c.clearInterval(c.intervl)
					}
				},
				13)
			}
		}
	}
	function a(h) {
		var j = null,
		i;
		if (typeof localStorage != "undefined") {
			try {
				j = localStorage;
				i = unescape(j.getItem(h));
				if (i) {
					return baidu.json.parse(i)
				}
				return null
			} catch(g) {
				//alert("localStorage is unreachable")
			}
		} else {
			if (c._infoaccessready) {
				i = baidu.json.parse((e(c.frames.userframe.window)[0]._getInfo(h)))
			} else {
				c.intvl = setInterval(function() {
					if (c._infoaccessready) {
						i = baidu.json.parse((e(c.frames.userframe.window)[0]._getInfo(h)));
						c.clearInterval(c.intvl)
					}
				},
				13)
			}
			return i
		}
	}
	d.init()
})(this.jQuery || this.baidu, this);