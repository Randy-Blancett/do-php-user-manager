Ext
		.define(
				'darkowl.userManager.user.view.cToolbar',
				{
					extend : 'Ext.toolbar.Toolbar',
					requires : [ 'Ext.button.Button',
							'darkowl.userManager.eventManager.cStartMenuEvents' ],
					initComponent : function() {
						this.callParent();

						if (g_obj_Config.m_bool_Add) {
							this
									.add(new Ext.button.Button(
											{
												text : "Add",
												iconCls : 'toolbar-user-add-icon',
												tooltip : "Add User",
												handler : function() {
													startMenu.MsgBus
															.fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
												}
											}));
						}

						if (g_obj_Config.m_bool_Edit) {
							this
									.add(new Ext.button.Button(
											{
												text : "Edit",
												iconCls : 'toolbar-user-edit-icon',
												tooltip : "Edit User",
												handler : function() {
													this
															.up("window")
															.fireEvent(
																	darkowl.userManager.user.view.cWindow.C_STR_EVENT_EDIT);
												}
											}));
						}

						if (g_obj_Config.m_bool_Delete) {
							this
									.add(new Ext.button.Button(
											{
												text : "Delete",
												iconCls : 'toolbar-user-delete-icon',
												tooltip : "Delete User",
												handler : function() {
													this
															.up("window")
															.fireEvent(
																	darkowl.userManager.user.view.cWindow.C_STR_EVENT_DELETE);
												}
											}));
						}
					}
				});