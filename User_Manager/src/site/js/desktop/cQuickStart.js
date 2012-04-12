Ext
		.define(
				'darkowl.desktop.cQuickStart',
				{
					extend : 'Ext.toolbar.Toolbar',
					minWidth : 20,
					width : 60,
					enableOverflow : true,
					items :
					[
						{
							tooltip :
							{
								text : "Logout",
								align : 'bl-tl'
							},
							overflowText : "Logout",
							iconCls : "quickstart_logout_icon",
							handler : function ()
							{
								//TODO implement Logout
				// m_obj_UserManager_App
				// .fireEvent(DarkOwl.User_Manager.EventHandler.cSystemEvents.C_STR_EVENT_LOGOUT);
							}
						}
					],
					
					initComponent : function ()
					{
						this.callParent();
						this.size_Box();
					},
					
					size_Box : function ()
					{
						var int_Width = 0;
						int_Width = this.items.getCount() * 30;
						this.setWidth(int_Width);
					}
				});