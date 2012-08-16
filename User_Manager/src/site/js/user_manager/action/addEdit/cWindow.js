Ext.define('darkowl.userManager.action.addEdit.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "Add/Edit Actions",
    requires :
    [ 'darkowl.userManager.action.addEdit.cForm'
    // 'darkowl.userManager.action.view.cGrid'
    ],
    iconCls : "window-action-edit-icon",
    width : 600,
    height : 300,
    shim : false,
    animCollapse : false,
    constrain : true,
    m_str_ID : "",
    layout : "fit",
    border : false,
    m_obj_Mask : null,
    initComponent : function()
    {
	    console.log(this.m_str_ID);
	    var obj_This = this;

	    this.m_obj_Form = Ext
	            .create('darkowl.userManager.action.addEdit.cForm');

	    this.callParent();

	    this.add(this.m_obj_Form);

	    if (this.m_str_ID)
	    {
		    this.showMask();
		    this.loadAction(this.m_str_ID);
	    }
	    this.on("afterrender", function()
	    {
		    if (this.m_bool_Mask)
		    {
			    this.showMask();
		    }
	    });
    },
    loadAction : function(str_ActionID)
    {
	    this.m_obj_Form.load(
	    {
	        url : "../rest/action/" + str_ActionID,
	        method : "get"
	    });

    },
    showMask : function()
    {
	    this.m_bool_Mask = true;
	    if (this.getEl())
	    {
		    if (!this.m_obj_Mask)
		    {
			    this.m_obj_Mask = new Ext.LoadMask(this.getEl(),
			    {
				    msg : "Loading Data..."
			    });
		    }
		    this.m_obj_Mask.show();
	    }
    }
});
