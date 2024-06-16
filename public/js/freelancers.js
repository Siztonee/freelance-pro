$(document).ready(function(){
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Переменные для хранения выбранных навыков
    let selectedSkills = [];

    // Обработка выбора специальности
    $('.specialization-link').on('click', function(e) {
        e.preventDefault();
        var specializationId = $(this).data('id');

        $.ajax({
            url: '/search-freelancer',
            method: 'POST',
            data: { category_id: specializationId },
            success: function(data) {
                var skillsContainer = $('#skills-container');
                var skillsList = $('#skills-list');
                skillsList.empty(); // Очистить предыдущие навыки

                data.skills.forEach(function(skill) {
                    var skillTag = `
                        <a href="#" class="bg-green-100 hover:bg-green-200 text-green-800 text-sm font-medium px-3 py-1 rounded-full skill-link" data-id="${skill.id}">
                            ${skill.name}
                        </a>
                    `;
                    skillsList.append(skillTag);
                });

                skillsContainer.show(); // Показать контейнер навыков
            }
        });
    });

    // Обработка выбора навыков
    $(document).on('click', '.skill-link', function(e) {
        e.preventDefault();
        var skillId = $(this).data('id');
        var skillName = $(this).text();

        if ($(this).hasClass('selected')) {
            // Убрать выбранный навык
            $(this).removeClass('selected bg-blue-200').addClass('bg-green-100');
            selectedSkills = selectedSkills.filter(function(skill) {
                return skill.id !== skillId;
            });
        } else {
            // Добавить выбранный навык
            $(this).removeClass('bg-green-100').addClass('selected bg-blue-200');
            selectedSkills.push({ id: skillId, name: skillName });
        }

        updateSelectedSkills();
    });

    // Обновление блока с выбранными навыками
    function updateSelectedSkills() {
        var selectedSkillsContainer = $('#selected-skills-container');
        var selectedSkillsList = $('#selected-skills-list');
        selectedSkillsList.empty(); // Очистить предыдущие выбранные навыки

        if (selectedSkills.length > 0) {
            selectedSkills.forEach(function(skill) {
                var skillTag = `
                    <span class="bg-blue-200 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                        ${skill.name}
                    </span>
                `;
                selectedSkillsList.append(skillTag);
            });

            selectedSkillsContainer.show(); // Показать контейнер выбранных навыков
        } else {
            selectedSkillsContainer.hide(); // Скрыть контейнер выбранных навыков
        }
    }
});
