Ext.define('darkowl.desktop.cWallPaper', {
			extend : 'Ext.Component',

			alias : 'widget.wallpaper',

			cls : 'ux-wallpaper',
			html : '<img src="' + Ext.BLANK_IMAGE_URL + '">',

			stretch : false,
			m_str_Wallpaper : null,

			afterRender : function() {
				this.callParent();
				this.setWallpaper(this.m_str_Wallpaper, this.stretch);
			},

			applyState : function() {
				var obj_This = this, old = this.wallpaper;
				this.callParent(arguments);
				if (old != this.m_str_Wallpaper) {
					this.setWallpaper(obj_This.wallpaper);
				}
			},
			
			 getState : function() {
				return this.wallpaper && {
					wallpaper : this.wallpaper
				};
			},
			
			setWallpaper : function(wallpaper, stretch) {
				var obj_This = this, imgEl, bkgnd;

				this.stretch = (stretch !== false);
				this.m_str_Wallpaper = wallpaper;

				if (this.rendered) {
					imgEl = obj_This.el.dom.firstChild;

					if (!wallpaper || wallpaper == Ext.BLANK_IMAGE_URL) {
						Ext.fly(imgEl).hide();
					} else if (obj_This.stretch) {
						imgEl.src = wallpaper;

						this.el.removeCls('ux-wallpaper-tiled');
						Ext.fly(imgEl).setStyle({
									width : '100%',
									height : '100%'
								}).show();
					} else {
						Ext.fly(imgEl).hide();

						bkgnd = 'url(' + wallpaper + ')';
						this.el.addCls('ux-wallpaper-tiled');
					}

					this.el.setStyle({
								backgroundImage : bkgnd || ''
							});
				}
				return this;
			}
		});