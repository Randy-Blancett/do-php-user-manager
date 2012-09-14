Ext.define('darkowl.userManager.action.addEdit.cForm',
{
    extend : 'Ext.form.Panel',
    requires :
    [ 'Ext.form.field.ComboBox', 'Ext.button.Button',
            'darkowl.userManager.store.cApplicationList',
            'darkowl.userManager.config.cLabel',
            'darkowl.userManager.config.cDialog',
            'darkowl.userManager.config.cButton' ],
    labelWidth : 100,
    m_str_ActionID : "",
    m_str_AppId : "",
    frame : true,
    bodyStyle : 'padding:5px 5px 0',
    standardSubmit : false,
    defaultType : 'textfield',

    initComponent : function()
    {
	    var obj_This = this;

	    str_Width = "98%";

	    this.m_obj_AppStore = Ext
	            .create('darkowl.userManager.store.cApplicationList');

	    // this.m_obj_AppStore.load();

	    this.m_obj_Application = Ext.create("Ext.form.field.ComboBox",
	    {
	        fieldLabel : userManager.lables.self.C_STR_ACTION_APPLICATION,
	        name : "application",
	        anchor : str_Width,
	        store : this.m_obj_AppStore,
	        queryParam : "prefix",
	        displayField : "name",
	        valueField : "id",
	        allowBlank : false
	    });

	    this.items =
	    [
	    {
	        fieldLabel : userManager.lables.self.C_STR_ACTION_ID,
	        name : "id",
	        anchor : str_Width,
	        inputType : "textfield",
	        readOnly : true,
	        allowBlank : true
	    },
	    {
	        fieldLabel : userManager.lables.self.C_STR_ACTION_NAME,
	        name : "name",
	        anchor : str_Width,
	        inputType : "textfield",
	        readOnly : false,
	        allowBlank : false
	    }, this.m_obj_Application,
	    {
	        fieldLabel : userManager.lables.self.C_STR_ACTION_COMMENT,
	        name : "comment",
	        anchor : str_Width,
	        xtype : 'textareafield',
	        allowBlank : true
	    } ];

	    this.m_obj_Submit = Ext.create('Ext.button.Button',
	    {
	        text : userManager.button.self.C_STR_GENERAL_SAVE,
	        // disabled:(!this.m_str_UserID),
	        handler : function()
	        {
		        obj_This.getForm().submit(
		        {
		            url : 'rest/action/',
		            waitMsg : userManager.dialog.self.C_STR_ACTION_SAVE_WAIT,
		            method : "put",
		            success : obj_This.success_Submit,
		            failure : obj_This.fail_Submit,
		            scope : obj_This
		        });
	        }
	    });

	    this.m_obj_Cancel = Ext.create('Ext.button.Button',
	    {
	        text : userManager.button.self.C_STR_GENERAL_CANCEL,
	        handler : function()
	        {
		        this.ownerCt.ownerCt.ownerCt.close();
	        }
	    });

	    this.buttons =
	    [ this.m_obj_Submit, this.m_obj_Cancel ];

	    this.callParent();
	    this.m_obj_AppStore.on("load", this.setData, this);
    },
    setData : function()
    {
	    this.m_obj_Application.setValue(this.m_str_AppId);
    }
});