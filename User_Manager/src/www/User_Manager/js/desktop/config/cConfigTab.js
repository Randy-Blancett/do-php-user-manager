Ext.define('darkowl.desktop.config.cConfigTab',
	{
		title: "Desktop Configuration",
		tooltip: 'Configuration of desktop application',
		closable: false,
		frame: true,
		extend: 'darkowl.desktop.config.abs_ConfigTab',
		labelWidth: 200,
		defaults: {
			anchor: "100%"
		},
		initComponent: function() {
			this.category = "Desktop";

			this.m_obj_ExtJSLibPath = Ext.create("Ext.form.field.Text", {
				fieldLabel: "ExtJS Path",
				name: "ext4LibPath",
				inputType: "textfield",
				readOnly: false,
				allowBlank: true
			});

			this.items = [
				this.m_obj_ExtJSLibPath
			];

			this.callParent();
		}
	});


