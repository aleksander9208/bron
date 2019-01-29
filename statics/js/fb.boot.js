$(document).ready(
    function ()
        {
            if (typeof window.fb == 'object')
                window.fb.init(
                    window.fb.tasks.add(
                        'Запуск ядра',
                        '',
                        function (result)
                            {
                                if (result.errors.length>0)
                                    window.fb.log('boot', 'event_ready', result.errors.join("\n"));
                            }
                    )
                );
        }
);