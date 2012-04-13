Ext
		.define(
				'darkowl.desktop.cStartMenu',
				{
					extend : 'Ext.panel.Panel',
					
					requires :
					[
							'Ext.menu.Menu', 'Ext.toolbar.Toolbar'
					],
					
					ariaRole : 'menu',
					cls : 'x-menu ux-start-menu',
					defaultAlign : 'bl-tl',
					iconCls : 'start-icon',
					floating : true,
					shadow : true,
					layout : 'fit',
					
					// We have to hardcode a width because the internal Menu
					// cannot drive our
					// width.
					// This is combined with changing the align property of the
					// menu's layout
					// from the
					// typical 'stretchmax' to 'stretch' which allows the the
					// items to fill the
					// menu
					// area.
					width : 300,
					height : 300,
					initComponent : function ()
					{
						
						this.buildMenu();
						
						this.items =
						[
							this.m_obj_Menu
						];
						
						Ext.menu.Manager.register(this);
						
						this.callParent();
						
						this.buildToolbar();
						this.addDocked(this.m_obj_Toolbar);
						
						this.on('deactivate', function ()
						{
							this.hide();
						});
					},
					
					buildToolbar : function ()
					{
						var obj_This = this;
						
						this.m_obj_Toolbar = Ext.create("Ext.toolbar.Toolbar",
						{
							width : 150,
							dock : 'right',
							cls : 'ux-start-menu-toolbar',
							vertical : true
						});
						
						this.m_obj_Toolbar.add(
						{
							text : 'test 1',
							iconCls : 'menu-create-db-icon',
							handler : function ()
							{
								// m_obj_UserManager_App.fireEvent(DarkOwl.User_Manager.EventHandler.cWindowEvents.C_STR_EVENT_CREATE_DATABASES)
							},
							scope : obj_This
						});
						
						this.m_obj_Toolbar.add('-');
						
						this.m_obj_Toolbar
								.add(
								{
									text : 'Logout',
									iconCls : 'menu-logout-icon',
									handler : function ()
									{
										m_obj_UserManager_App
												.fireEvent(darkowl.desktop.eventManager.cDesktopEvents.self.C_STR_EVENT_LOGOUT);
									},
									scope : obj_This
								});
						
						this.m_obj_Toolbar.layout.align = 'stretch';
					},
					
					buildMenu : function ()
					{
						this.m_obj_Menu = Ext.create("Ext.menu.Menu",
						{
							cls : 'ux-start-menu-body',
							border : false,
							floating : false
						});
						
						this.m_obj_Menu.layout.align = 'stretch';
					},
					
					addMenuItem : function (obj_Item)
					{
						this.m_obj_Menu.add(obj_Item);
					},
					
					addToolItem : function ()
					{
						var cmp = this.m_obj_Toolbar;
						cmp.add.apply(cmp, arguments);
					},
					
					showBy : function (cmp, pos, off)
					{
						
						if (this.floating && cmp)
						{
							this.layout.autoSize = true;
							this.show();
							
							// Component or Element
							cmp = cmp.el || cmp;
							
							// Convert absolute to floatParent-relative
							// coordinates if
							// necessary.
							var xy = this.el.getAlignToXY(cmp, pos
									|| this.defaultAlign, off);
							if (this.floatParent)
							{
								var r = this.floatParent.getTargetEl()
										.getViewRegion();
								xy[0] -= r.x;
								xy[1] -= r.y;
							}
							this.showAt(xy);
							this.doConstrain();
						}
						return this;
					}
				}); // StartMenu
