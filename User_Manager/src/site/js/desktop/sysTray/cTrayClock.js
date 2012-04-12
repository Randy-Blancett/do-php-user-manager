Ext
		.define(
				'darkowl.desktop.sysTray.cTrayClock',
				{
					extend : 'Ext.toolbar.TextItem',
					alias : 'widget.trayclock',
					cls : 'ux-desktop-trayclock',
					html : '&#160;',
					timeFormat : 'g:i A',
					tpl : '{time}',
					
					initComponent : function ()
					{
						this.callParent();
						
						if (typeof (this.tpl) == 'string')
						{
							this.tpl = new Ext.XTemplate(this.tpl);
						}
					},
					
					afterRender : function ()
					{
						Ext.Function.defer(this.updateTime, 100, this);
						this.callParent();
					},
					
					onDestroy : function ()
					{
						if (this.timer)
						{
							window.clearTimeout(this.timer);
							this.timer = null;
						}
						
						this.callParent();
					},
					
					updateTime : function ()
					{
						var time = Ext.Date.format(new Date(), this.timeFormat), text = this.tpl
								.apply(
								{
									time : time
								});
						if (this.lastText != text)
						{
							this.setText(text);
							this.lastText = text;
						}
						this.timer = Ext.Function.defer(this.updateTime, 10000,
								this);
					}
				});
