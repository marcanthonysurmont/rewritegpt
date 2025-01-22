<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RewriteGPT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">RewriteGPT</h1>
            <p class="text-gray-400">
                Copy text, then press <span class="font-bold">Ctrl + Alt + C</span> (Windows) or <span class="font-bold">⌘ + ⌥ + C</span> (Mac)
            </p>
        </div>

        <!-- Options Section -->
        <div class="bg-gray-800 shadow-lg rounded-lg p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-white">Processing Options</h2>
                <button 
                    data-modal-trigger
                    class="text-gray-400 hover:text-white bg-gray-700 hover:bg-gray-600 rounded-md px-3 py-2 text-sm transition-colors duration-200 flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                
                </button>
            </div>
            <form action="{{ route('store.prompt') }}" method="POST" class="space-y-6" id="prompt_form">
                @csrf
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center">
                            <input
                                type="radio"
                                id="rewrite"
                                name="prompt"
                                value="1"
                                @if(isset($config['prompt_id']) && $config['prompt_id'] === 1) checked @endif
                                data-language-trigger
                                class="h-4 w-4 text-blue-700 bg-gray-700 border-gray-600 focus:ring-blue-700 focus:ring-offset-gray-800"
                            >
                            <label for="rewrite" class="ml-2 text-sm font-medium text-gray-300">
                                Rewrite Text
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                type="radio"
                                id="translate"
                                name="prompt"
                                value="2"
                                @if(isset($config['prompt_id']) && $config['prompt_id'] === 2) checked @endif
                                data-language-trigger
                                class="h-4 w-4 text-blue-700 bg-gray-700 border-gray-600 focus:ring-blue-700 focus:ring-offset-gray-800"
                            >
                            <label for="translate" class="ml-2 text-sm font-medium text-gray-300">
                                Translate Text
                            </label>
                        </div>
                    </div>

                    <select
                        id="languageSelect"
                        name="language"
                        class="w-full rounded-md bg-gray-700 border-gray-600 text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent scrollbar-thin scrollbar-thumb-blue-700 scrollbar-track-gray-600"
                        style="display: {{ isset($config['prompt_id']) && $config['prompt_id'] === 2 ? 'block' : 'none' }}"
                        >
                        <option value="Afrikaans">Afrikaans</option>
                        <option value="Albanian">Albanian</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Armenian">Armenian</option>
                        <option value="Basque">Basque</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Bulgarian">Bulgarian</option>
                        <option value="Catalan">Catalan</option>
                        <option value="Cambodian">Cambodian</option>
                        <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                        <option value="Croatian">Croatian</option>
                        <option value="Czech">Czech</option>
                        <option value="Danish">Danish</option>
                        <option value="Dutch">Dutch</option>
                        <option value="English" selected>English</option>
                        <option value="Estonian">Estonian</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finnish">Finnish</option>
                        <option value="French">French</option>
                        <option value="Georgian">Georgian</option>
                        <option value="German">German</option>
                        <option value="Greek">Greek</option>
                        <option value="Gujarati">Gujarati</option>
                        <option value="Hebrew">Hebrew</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Hungarian">Hungarian</option>
                        <option value="Icelandic">Icelandic</option>
                        <option value="Indonesian">Indonesian</option>
                        <option value="Irish">Irish</option>
                        <option value="Italian">Italian</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Javanese">Javanese</option>
                        <option value="Korean">Korean</option>
                        <option value="Latin">Latin</option>
                        <option value="Latvian">Latvian</option>
                        <option value="Lithuanian">Lithuanian</option>
                        <option value="Macedonian">Macedonian</option>
                        <option value="Malay">Malay</option>
                        <option value="Malayalam">Malayalam</option>
                        <option value="Maltese">Maltese</option>
                        <option value="Maori">Maori</option>
                        <option value="Marathi">Marathi</option>
                        <option value="Mongolian">Mongolian</option>
                        <option value="Nepali">Nepali</option>
                        <option value="Norwegian">Norwegian</option>
                        <option value="Persian">Persian</option>
                        <option value="Polish">Polish</option>
                        <option value="Portuguese">Portuguese</option>
                        <option value="Punjabi">Punjabi</option>
                        <option value="Quechua">Quechua</option>
                        <option value="Romanian">Romanian</option>
                        <option value="Russian">Russian</option>
                        <option value="Samoan">Samoan</option>
                        <option value="Serbian">Serbian</option>
                        <option value="Slovak">Slovak</option>
                        <option value="Slovenian">Slovenian</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Swahili">Swahili</option>
                        <option value="Swedish">Swedish</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Tatar">Tatar</option>
                        <option value="Telugu">Telugu</option>
                        <option value="Thai">Thai</option>
                        <option value="Tibetan">Tibetan</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Turkish">Turkish</option>
                        <option value="Ukrainian">Ukrainian</option>
                        <option value="Urdu">Urdu</option>
                        <option value="Uzbek">Uzbek</option>
                        <option value="Vietnamese">Vietnamese</option>
                        <option value="Welsh">Welsh</option>
                        <option value="Xhosa">Xhosa</option>
                    </select>

                    <button type="submit" class="w-full bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition-colors">
                        Save Options
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Settings Modal -->
    <div id="settingsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-white">API Configuration</h2>
                <button 
                data-modal-trigger
                class="text-gray-400 hover:text-white"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('store.apikey') }}" method="POST" class="space-y-4" id="api_key_form">
                @csrf
                <div>
                    <label for="api_key" class="block text-sm font-medium text-gray-300 mb-1">
                        OpenAI API Key
                    </label>
                    <input
                    type="text"
                    name="api_key"
                    id="api_key"
                    placeholder="Enter your OpenAI API key here..."
                    value="{{ $config['api_key'] ?? '' }}"
                    class="w-full rounded-md bg-gray-700 border-gray-600 text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent placeholder-gray-400 blur-[2px] focus:blur-none transition-all duration-300"
                    />
                </div>
                <button type="submit" class="w-full bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition-colors">
                    Save API Key
                </button>
            </form>
        </div>
    </div>

    <!-- Notifcations -->
    <div id="notification-container" class="fixed top-5 right-5 space-y-4 z-50"></div>

</div>
</body>
</html>