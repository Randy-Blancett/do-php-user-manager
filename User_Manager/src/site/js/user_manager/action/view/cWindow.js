Ext.define('darkowl.userManager.action.view.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "View Actions",
    requires :
    [ 'darkowl.userManager.action.view.cToolbar',
            'darkowl.userManager.config.cDialog',
            'darkowl.userManager.action.view.cGrid' ],
    iconCls : "window-action-view-icon",
    width : 600,
    height : 480,
    shim : false,
    animCollapse : false,
    constrain : true,
    layout : "fit",
    border : false,
    statics :
    {
	    C_STR_EVENT_EDIT : "doedit"
    },
    constructor : function(config)
    {
	    this.callParent(arguments);
	    this.addMsgEvents();
    },

    addMsgEvents : function()
    {
	    this.addEvents(this.self.C_STR_EVENT_EDIT);
	    this.on(this.self.C_STR_EVENT_EDIT, this.editAction);
    },
    initComponent : function()
    {
	    var obj_This = this;

	    this.m_obj_TopBar = Ext.create(
	            'darkowl.userManager.action.view.cToolbar',
	            {
		            dock : 'top'
	            });

	    this.m_obj_Grid = Ext.create('darkowl.userManager.action.view.cGrid');

	    this.callParent();

	    this.addDocked(this.m_obj_TopBar);
	    this.add(this.m_obj_Grid);
    },
    editAction : function()
    {
	    var arr_Selection = this.m_obj_Grid.getSelectionModel().getSelection();

	    switch (arr_Selection.length)
	    {
		    case 0:
			    Ext.Msg.show(
			    {
			        title : 'Invalid Selection?',
			        msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONE,
			        buttons : Ext.Msg.OK,
			        icon : Ext.Msg.ERROR
			    });
			    break;
		    case 1:
			    startMenu.MsgBus.fireEvent(
			            startMenu.MsgBus.self.C_STR_EVENT_OPEN_ACTION_EDIT,
			            arr_Selection[0].get("id"));
			    break;
		    default:
			    Ext.Msg.show(
			    {
			        title : 'Invalid Selection?',
			        msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONLY_ONE,
			        buttons : Ext.Msg.OK,
			        icon : Ext.Msg.ERROR
			    });
	    }

    }
});
