$(document).ready(function () {
    let countries = [];

    $.getJSON('/countries.json', function (data) {
        countries = data.map(country => country.name); // Преобразуем массив объектов в массив строк с именами стран
    });

    $('#location').on('input', function () {
        const query = $(this).val().toLowerCase();
        const resultsList = $('#results_location');
        resultsList.empty();

        if (query.length === 0) {
            resultsList.addClass('hidden');
            return;
        }

        let matches = countries.filter(country => country.toLowerCase().includes(query));

        if (matches.length > 3) {
            matches = matches.slice(0, 3);
        }

        if (matches.length > 0) {
            matches.forEach(match => {
                const listItem = $('<li></li>').addClass('p-2 border-b last:border-b-0').text(match);
                resultsList.append(listItem);
            });
            resultsList.removeClass('hidden');
        } else {
            resultsList.addClass('hidden');
        }
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#location').length) {
            $('#results_location').addClass('hidden');
        }
    });

    $(document).on('click', '#results_location li', function () {
        $('#location').val($(this).text());
        $('#results_location').addClass('hidden');
    });
});


$(document).ready(function () {

    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Устанавливаем CSRF-токен для всех AJAX-запросов
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    const routeUrl = $('#getSpec_url').data('url');

    var search = _.debounce(function (query) {
        if (query.trim() === '') {
            $('#results_spec').empty().addClass('hidden');
            return;
        }

        $.ajax({
            url: routeUrl,
            type: 'POST',
            data: {
                query: query
            },
            success: function (data) {
                var resultsList = $('#results_spec');
                resultsList.empty();

                if (data.length === 0) {
                    resultsList.append('<li class="text-gray-500">No results found</li>');
                } else {
                    data.forEach(function (item) {
                        var listItem = $('<li></li>').addClass('p-2 border-b last:border-b-0').text(item.name);
                        resultsList.append(listItem);
                    });
                }

                resultsList.removeClass('hidden');
            }
        });
    }, 300); // 300 миллисекунд задержки

    $('#search_spec').on('input', function () {
        var query = $(this).val();

        if (query.length === 0) {
            $('#results_spec').addClass('hidden');
        } else {
            search(query);
        }
    });

    $(document).on('click', '#results_spec li', function () {
        $('#search_spec').val($(this).text());
        $('#results_spec').addClass('hidden');
    });
});


$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    const routeUrl = $('#new_skill').data('url');
    let selectedSkills = {}; // Хранит выбранные навыки

    // Инициализируем выбранные навыки из скрытого поля
    $('#selectedSkills .skill-tag').each(function () {
        const skillName = $(this).data('skill-name');
        selectedSkills[skillName] = true;
    });

    // Обработка ввода нового навыка
    $('#new_skill').on('input', function () {
        const query = $(this).val().trim();
        if (query.length === 0) {
            $('#skillResults').addClass('hidden').empty();
            return;
        }

        $.ajax({
            url: routeUrl,
            method: 'POST',
            data: {query: query},
            success: function (response) {
                const skills = response;
                const skillResults = $('#skillResults');
                skillResults.empty();

                if (skills.length === 0) {
                    skillResults.append('<span class="text-gray-500">Навыков не найдено</span>');
                } else {
                    skills.forEach(skill => {
                        if (!selectedSkills[skill.name]) {
                            const skillTag = $('<span></span>')
                                .addClass('bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2 skill-tag')
                                .text(skill.name)
                                .attr('data-skill-name', skill.name)
                                .on('click', function () {
                                    const skillName = $(this).data('skill-name');
                                    selectedSkills[skillName] = true;

                                    const selectedSkillTag = $('<span></span>')
                                        .addClass('bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2 skill-tag')
                                        .text(skillName)
                                        .attr('data-skill-name', skillName)
                                        .appendTo('#selectedSkills')
                                        .on('click', function () {
                                            $(this).remove();
                                            delete selectedSkills[skillName];
                                            updateSelectedSkillsInput();
                                        });

                                    $(this).remove();
                                    updateSelectedSkillsInput();
                                });

                            skillResults.append(skillTag);
                        }
                    });
                }

                skillResults.removeClass('hidden');
            }
        });
    });

    function updateSelectedSkillsInput() {
        const selectedSkillsArray = Object.keys(selectedSkills).filter(skill => selectedSkills[skill]);
        $('#selectedSkillsInput').val(selectedSkillsArray.join(','));
    }
});


