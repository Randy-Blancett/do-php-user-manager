Ext
		.define(
				'darkowl.desktop.cApplication',
				{
					mixins :
					{
						observable : 'Ext.util.Observable'
					},
					
					requires :
					[
							'darkowl.desktop.cDesktop',
							'darkowl.desktop.config.cConfig',
							'darkowl.desktop.util.cLogger',
							'darkowl.desktop.eventManager.cDesktopEvents',
							'darkowl.desktop.eventManager.cDesktopEvents',
							'Ext.window.MessageBox',
							// 'DarkOwl.User_Manager.EventHandler.cSystemEvents',
							// 'DarkOwl.User_Manager.EventHandler.cWindowEvents',
							//	     
							// 'Ext.container.Viewport',
							'Ext.util.MixedCollection'
					],
					m_obj_Windows : null,
					m_obj_SystemEvents : null,
					m_obj_WindowEvents : null,
					m_obj_Desktop : null,
					m_obj_ViewPort : null,
					m_arr_Modules : null,
					m_bool_LoadMod : false,
					
					isReady : false,
					
					constructor : function (config)
					{
						var obj_This = this;
						// Ext.desktop = new Object();
						
						this.m_obj_Windows = Ext
								.create("Ext.util.MixedCollection");
						this.m_obj_Modules = Ext
								.create('Ext.util.MixedCollection');
						
						// add Events to object
						this.addEvents('ready', 'beforeunload');
						
						darkowl.desktop.eventManager.cDesktopEvents
								.setMsgBus(this);
						darkowl.desktop.eventManager.cDesktopEvents
								.addMsgEvents();
						
						this.mixins.observable.constructor.call(this, config);
						
						if (Ext.isReady)
						{
							Ext.Function.defer(obj_This.init, 10, obj_This);
						}
						else
						{
							Ext.onReady(obj_This.init, obj_This);
						}
					},
					
					init : function ()
					{
						var obj_This = this;
						
						Ext.QuickTips.init();
						
						this.m_obj_Desktop = Ext
								.create(
										"darkowl.desktop.cDesktop",
										{
											m_obj_Windows : this.m_obj_Windows,
											m_str_WallPaper : "../img/Wallpaper/desktop.jpg"
										});
						
						obj_This.m_obj_ViewPort = Ext.create(
								"Ext.container.Viewport",
								{
									layout : 'fit',
									items :
									[
										this.m_obj_Desktop
									]
								});
						
						Ext.EventManager.on(window, 'beforeunload',
								obj_This.onUnload, obj_This);
						
						obj_This.isReady = true;
						obj_This.fireEvent('ready', obj_This);
						
						this.m_bool_LoadMod = true;
						this.loadAllModules();
						
						this
								.on(
										darkowl.desktop.eventManager.cDesktopEvents.self.C_STR_EVENT_LOGOUT,
										this.doLogout, this);
					},
					
					onReady : function (fn, scope)
					{
						if (this.isReady)
						{
							fn.call(scope, this);
						}
						else
						{
							this.on(
							{
								ready : fn,
								scope : scope,
								single : true
							});
						}
					},
					
					getDesktop : function ()
					{
						return this.m_obj_Desktop;
					},
					
					loadAllModules : function ()
					{
						this.m_obj_Modules.eachKey(function (str_Key,
								obj_Module)
						{
							this.addModule(obj_Module);
						}, this);
					},
					
					addModule : function (obj_Module)
					{
						this.m_obj_Modules
								.add(obj_Module.getName(), obj_Module);
						if (this.m_bool_LoadMod)
						{
							this.m_obj_Desktop.addShortcut(obj_Module
									.getShortcuts());
							this.m_obj_Desktop.addQuickStart(obj_Module
									.getQuickStart());
							this.m_obj_Desktop.addStartMenu(obj_Module
									.getStartMenu());
						}
					},
					
					onUnload : function (e)
					{
						if (this.fireEvent('beforeunload', this) === false)
						{
							e.stopEvent();
						}
					},
					doLogout : function ()
					{
						// TODO make this use a config file for text and config
						// what the logout file is.
						Ext.Msg.show(
						{
							title : "Logout",
							msg : "Are you sure you wish to logout?",
							buttons : Ext.Msg.YESNO,
							icon : Ext.Msg.QUESTION,
							fn : function (str_Btn, str_Text, obj_Opt)
							{
								if (str_Btn.toUpperCase() == "YES")
								{
									location = darkowl.desktop.config.cConfig
											.getLogoutURL();
									return;
								}
							}
						});
					}
				});