define('custom:views/smart-reminder-settings', ['view'], function (Dep) {

    return Dep.extend({

        template: 'custom:smart-reminder-settings',

        events: {
            'click [data-action="saveSettings"]': 'saveSettings'
        },

        setup: function () {
            Dep.prototype.setup.call(this);

            this.smartRemindersEnabled = true;
            this.reminderTime = '10:00';
            this.reminderInterval = 3;
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            this.$el.find('[name="smartRemindersEnabled"]')
                .prop('checked', this.smartRemindersEnabled);

            this.$el.find('[name="reminderTime"]')
                .val(this.reminderTime);

            this.$el.find('[name="reminderInterval"]')
                .val(this.reminderInterval);
        },

        saveSettings: function () {
            this.smartRemindersEnabled =
                this.$el.find('[name="smartRemindersEnabled"]').is(':checked');

            this.reminderTime =
                this.$el.find('[name="reminderTime"]').val();

            this.reminderInterval =
                this.$el.find('[name="reminderInterval"]').val();

            this.notify('Smart Reminder settings saved successfully.', 'success');
        }
    });
});