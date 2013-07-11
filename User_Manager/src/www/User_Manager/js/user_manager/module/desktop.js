Ext
		.define(
				'darkowl.userManager.module.desktop',
				{
					extend : 'darkowl.desktop.module.abs_Module',
					// singleton : true,
					m_str_Name : "User Manager Desktop",
					requires : [ 'Ext.data.Store',
							'darkowl.desktop.eventManager.cDesktopEvents',
							'darkowl.userManager.setup.window.cWindow',
							'darkowl.userManager.eventManager.cStartMenuEvents' ],
					constructor : function(config) {
						this.buildGeneralMenu();
						this.buildSpecialMenu();
					},
					buildSpecialMenu : function() {
						this.m_obj_SpecialStartMenu = new Ext.util.MixedCollection();

						this.m_obj_SpecialStartMenu
								.add(
										'Create Tables',
										{
											iconCls : "menu-create-db-icon",
											onClick : function() {
												desktop.MsgBus
														.fireEvent(
																desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
																{},
																'darkowl.userManager.setup.window.cWindow');
											}
										});

						this.m_obj_SpecialStartMenu
								.add(
										'Configure',
										{
											iconCls : "menu-create-db-icon",
											onClick : function() {
												desktop.MsgBus
														.fireEvent(
																desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
																{},
																'darkowl.userManager.setup.window.cWindow');
											}
										});
					},

					buildGeneralMenu : function() {
						this.m_obj_GeneralStartMenu = new Ext.util.MixedCollection();

						this.m_obj_GeneralStartMenu.add('Action', {
							iconCls : "menu-action-icon",
							submenu : this.buildActionMenu()
						});

						this.m_obj_GeneralStartMenu.add('Application', {
							iconCls : "menu-application-icon",
							submenu : this.buildAppMenu()
						});

						this.m_obj_GeneralStartMenu.add('Group', {
							iconCls : "menu-group-icon",
							submenu : this.buildGroupMenu()
						});

						this.m_obj_GeneralStartMenu.add('User', {
							iconCls : "menu-user-icon",
							submenu : this.buildUserMenu()
						});

					},
					buildActionMenu : function() {
						var obj_Menu = new Ext.util.MixedCollection();

						if (g_obj_Config.m_bool_Action_Add) {
							obj_Menu
									.add(
											'Add',
											{
												iconCls : "menu-action-add-icon",
												onClick : function() {
													startMenu.MsgBus
															.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_ACTION_ADD);
												}
											});
						}
						obj_Menu
								.add(
										'View',
										{
											iconCls : "menu-action-view-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_ACTION_VIEW);
											}
										});
						return obj_Menu;
					},
					buildAppMenu : function() {
						var obj_Menu = new Ext.util.MixedCollection();

						obj_Menu
								.add(
										'Add',
										{
											iconCls : "menu-application-add-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_APP_ADD);
											}
										});
						obj_Menu
								.add(
										'View',
										{
											iconCls : "menu-application-view-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_APP_VIEW);
											}
										});
						return obj_Menu;
					},
					buildGroupMenu : function() {
						var obj_Menu = new Ext.util.MixedCollection();

						obj_Menu
								.add(
										'Add',
										{
											iconCls : "menu-group-add-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_ADD);
											}
										});
						obj_Menu
								.add(
										'View',
										{
											iconCls : "menu-group-view-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_VIEW);
											}
										});
						return obj_Menu;
					},
					buildUserMenu : function() {
						var obj_Menu = new Ext.util.MixedCollection();

						obj_Menu
								.add(
										'Add',
										{
											iconCls : "menu-user-add-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
											}
										});
						obj_Menu
								.add(
										'View',
										{
											iconCls : "menu-user-view-icon",
											onClick : function() {
												startMenu.MsgBus
														.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_VIEW);
											}
										});
						return obj_Menu;
					}
				});