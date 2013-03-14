Ext
		.define(
				'darkowl.desktop.cWindowBar',
				{
					extend : 'Ext.toolbar.Toolbar',
					requires :
					[
						"Ext.button.Button"
					],
					uses : [],
					
					flex : 1,
					cls : 'ux-desktop-windowbar',
					// items : [ '&#160;' ],
					height : 30,
					layout :
					{
						overflowHandler : 'Scroller'
					},
					
					initComponent : function ()
					{
						var obj_This = this;
						
						// Add Events
						//TODO Add event for add Task
		// m_obj_UserManager_App
		// .on(
		// DarkOwl.User_Manager.EventHandler.cWindowEvents.C_STR_EVENT_ADD_TASK,
		// obj_This.addTaskButton, obj_This);
						
						this.callParent();
					},
					
					addTaskButton : function (obj_Win)
					{
						var obj_TaskWindow = Ext.create("Ext.button.Button",
						{
							iconCls : obj_Win.iconCls,
							enableToggle : true,
							toggleGroup : 'all',
							maxWidth : 140,
							flex : 1,
							height : 24,
							text : Ext.util.Format.ellipsis(obj_Win.title, 20),
							listeners :
							{
								click : this.onClick,
								scope : this
							},
							win : obj_Win
						});
						
						var obj_Button = this.add(obj_TaskWindow);
						
						obj_Win.on("activate", function ()
						{
							obj_Button.toggle(true);
						});
						
						obj_Win.on("destroy", function ()
						{
							obj_Button.destroy();
						});
						
						obj_Button.toggle(true);
						return obj_Button;
					},
					
					onClick : function (obj_Btn)
					{
						var obj_Win = obj_Btn.win;
						
						if (obj_Win.isHidden())
						{
							obj_Win.show();
						}
						else
						{
							if (!obj_Win.m_bool_Active)
							{
								obj_Win.toFront()
							}
							else
							{
								obj_Win.minimize();
							}
						}
					}
				});