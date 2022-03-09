jQuery.extend(jQuery.validator.messages, {
    required:  (para, el) => `${$(el).attr('data-label')} is required field.`,
    email: "Please enter your email address correctly.",
    digits: (para, el) => `${$(el).attr('data-label')} format is not correct. Please enter digits only.`,
});