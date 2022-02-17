$(document).ready(
    function ()
        {
            if (typeof window.z == 'object')
                window.z.init(
                    window.z.tasks.add(
                        'Запуск ядра',
                        '',
                        function (result)
                            {
                                if (result.errors.length>0)
                                    window.z.log('boot', 'event_ready', result.errors.join("\n"));
                            }
                    )
                );
        }
);