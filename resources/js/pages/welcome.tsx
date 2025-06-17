import { Head, Link } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import { type SharedData } from '@/types';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Organiza">
                <meta charSet="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="Organiza is a task and process organization application designed to boost productivity and streamline workflows." />
                <meta name="author" content="Organiza Team" />
                <meta property="og:site_name" content="Organiza" />
                <meta property="og:site" content="https://Organiza.com" />
                <meta property="og:title" content="Organiza - Organize Your Tasks Efficiently" />
                <meta property="og:description" content="Organiza helps you gather, organize, and resolve tasks from anywhere, ensuring productivity and efficiency." />
                <meta property="og:image" content="/assets/images/hero.png" />
                <meta property="og:url" content="https://Organiza.com" />
                <meta name="twitter:card" content="summary_large_image" />
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
                <link href="/assets/css/output.css" rel="stylesheet" />
            </Head>
            <div className="font-instrument-sans bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a] dark:text-[#EDEDEC]">
                {/* Navigation */}
                <nav className="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-[#0a0a0a] shadow-sm">
                    <div className="container mx-auto px-4 sm:px-8 lg:flex lg:items-center lg:justify-between">
                        <div className="flex items-center justify-between py-4">
                            <Link href="/" className="text-3xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] no-underline">
                                Organiza
                            </Link>
                            <button
                                className="lg:hidden text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none"
                                type="button"
                                onClick={() => document.getElementById('navbarsExampleDefault')?.classList.toggle('hidden')}
                            >
                                <span className="inline-block w-8 h-8">
                                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div className="hidden lg:flex lg:items-center lg:flex-grow lg:justify-end" id="navbarsExampleDefault">
                            <ul className="flex flex-col lg:flex-row list-none lg:ml-auto gap-6">
                                <li>
                                    <Link href="#header" className="text-sm hover:text-[#62605b] dark:hover:text-[#62605b]">
                                        Início
                                    </Link>
                                </li>
                                <li>
                                    <Link href="#features" className="text-sm hover:text-[#62605b] dark:hover:text-[#62605b]">
                                        Funcionalidades
                                    </Link>
                                </li>
                                <li>
                                    <Link href="#details" className="text-sm hover:text-[#62605b] dark:hover:text-[#62605b]">
                                        Detalhes
                                    </Link>
                                </li>
                                <li>
                                    <Link href="#pricing" className="text-sm hover:text-[#62605b] dark:hover:text-[#62605b]">
                                        Preços
                                    </Link>
                                </li>
                                <li className="relative group">
                                    <button className="text-sm hover:text-[#62605b] dark:hover:text-[#62605b] flex items-center">
                                        Soltar
                                        <svg className="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div className="absolute hidden group-hover:block bg-white dark:bg-[#0a0a0a] shadow-lg rounded-sm mt-2">
                                        <Link href="/terms" className="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-[#1b1b18]">
                                            Termos e Condições
                                        </Link>
                                        <Link href="/privacy" className="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-[#1b1b18]">
                                            Política de Privacidade
                                        </Link>
                                    </div>
                                </li>
                                {auth.user ? (
                                    <li>
                                        <Link
                                            href={route('dashboard')}
                                            className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]"
                                        >
                                            Dashboard
                                        </Link>
                                    </li>
                                ) : (
                                    <>
                                        <li>
                                            <Link
                                                href={route('login')}
                                                className="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal hover:border-[#19140035] dark:hover:border-[#3E3E3A]"
                                            >
                                                Log in
                                            </Link>
                                        </li>
                                        <li>
                                            <Link
                                                href={route('register')}
                                                className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]"
                                            >
                                                Register
                                            </Link>
                                        </li>
                                    </>
                                )}
                            </ul>
                        </div>
                    </div>
                </nav>

                {/* Header */}
                <header id="header" className="pt-28 pb-20 text-center lg:text-left lg:pt-36 xl:pt-44 xl:pb-32">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                        <div className="mb-16 lg:mt-32 xl:mt-40 xl:mr-12">
                            <h1 className="text-4xl md:text-5xl font-bold mb-5">
                                Reúna, organize e resolva suas tarefas de qualquer lugar.
                            </h1>
                            <p className="text-lg mb-8">
                                Fuja da bagunça e do caos. Seja mais produtivo com o Organiza.
                            </p>
                            <Link href={route('register')} className="inline-block bg-[#1b1b18] text-white px-6 py-3 rounded-sm hover:bg-[#62605b] mr-2">
                                Criar conta
                            </Link>
                            <Link href={route('login')} className="inline-block bg-transparent border border-[#19140035] text-[#1b1b18] px-6 py-3 rounded-sm hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                                Acessar
                            </Link>
                        </div>
                        <div className="xl:text-right">
                            <img className="inline" src="/assets/images/hero.png" alt="Organiza Hero" />
                        </div>
                    </div>
                </header>

                {/* Introduction */}
                <div className="pt-4 pb-14 text-center">
                    <div className="container mx-auto px-4 sm:px-8 xl:px-4">
                        <p className="mb-4 text-2xl leading-10 lg:max-w-5xl lg:mx-auto">
                            Organiza, em relação a outros serviços com mesmo propósito, destaca-se em muitos aspectos mencionados abaixo. Não hesite em dar uma chance, temos a certeza de irás amar.
                        </p>
                    </div>
                </div>

                {/* Features */}
                <div id="features" className="py-12">
                    <div className="container mx-auto px-4 sm:px-8 xl:px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {[
                            { icon: 'features-icon-1.svg', title: 'Notificações Constantes', desc: 'Com o Organiza, você nunca esquecerá nenhuma tarefa importante' },
                            { icon: 'features-icon-2.svg', title: 'Recursos Leves', desc: 'Funciona suavemente mesmo em dispositivos mais antigos graças as tecnologias utilizadas' },
                            { icon: 'features-icon-3.svg', title: 'Excelente Performance', desc: 'Técnicas de otimização e tecnologias inovadoras garantem rapidez na utilização do Organiza' },
                            { icon: 'features-icon-4.svg', title: 'Linguagens múltiplas', desc: 'Não se preocupe com a questão do idioma, nossa plataforma suporta diversas línguas.' },
                            { icon: 'features-icon-5.svg', title: 'Atualizações Grátis', desc: 'Não se preocupe com custos futuros, vai receber atualizações constantes' },
                            { icon: 'features-icon-6.svg', title: 'Suporte da Comunidade', desc: 'Crie uma conta e obtenha acesso as ideias da comunidade online do Organiza' },
                        ].map((feature, index) => (
                            <div key={index} className="bg-white dark:bg-[#1b1b18] rounded-lg shadow p-6 text-center">
                                <img src={`/assets/images/${feature.icon}`} alt={feature.title} className="mx-auto mb-4" />
                                <h5 className="text-xl font-semibold mb-2">{feature.title}</h5>
                                <p>{feature.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Details 1 */}
                <div id="details" className="pt-12 pb-16 lg:pt-16">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
                        <div className="lg:col-span-5">
                            <div className="mb-16 lg:mb-0 xl:mt-16">
                                <h2 className="text-3xl font-bold mb-6">Sincronização de conta</h2>
                                <p className="mb-4">
                                    O Organiza utiliza tecnologias de sincronização de contas, ou seja, não importa qual seja o dispositivo você estará sempre atualizado nas suas tarefas.
                                </p>
                                <p>
                                    Seja no laptop, telefone, tablet, com o Organiza você nunca perderá nenhuma tarefa importante.
                                </p>
                            </div>
                        </div>
                        <div className="lg:col-span-7">
                            <div className="xl:ml-14">
                                <img className="inline" src="/assets/images/hero-img.png" alt="Account Sync" />
                            </div>
                        </div>
                    </div>
                </div>

                {/* Details 2 */}
                <div className="py-24">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
                        <div className="lg:col-span-7">
                            <div className="mb-12 lg:mb-0 xl:mr-14">
                                <img className="inline" src="/assets/images/timing-project-scheduling_74855-4584.avif" alt="Results" />
                            </div>
                        </div>
                        <div className="lg:col-span-5">
                            <div className="xl:mt-12">
                                <h2 className="text-3xl font-bold mb-6">Resultados notáveis</h2>
                                <ul className="space-y-2 mb-7">
                                    {['Realização do trabalho de forma eficiente', 'Cumprimento dos prazos', 'Maior produtividade'].map((item, index) => (
                                        <li key={index} className="flex items-center">
                                            <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                            <span>{item}</span>
                                        </li>
                                    ))}
                                </ul>
                                <Link href="#details-lightbox" className="inline-block bg-[#1b1b18] text-white px-6 py-3 rounded-sm hover:bg-[#62605b]">
                                    Detalhes
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Details Lightbox (Modal) */}
                <div id="details-lightbox" className="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div className="bg-white dark:bg-[#1b1b18] rounded-lg p-6 max-w-4xl w-full lg:grid lg:grid-cols-12 lg:gap-x-8">
                        <button className="absolute top-4 right-4 text-2xl" onClick={() => document.getElementById('details-lightbox')?.classList.add('hidden')}>
                            ×
                        </button>
                        <div className="lg:col-span-8 mb-8 lg:mb-0">
                            <img className="rounded-lg w-full" src="/assets/images/details-lightbox.jpg" alt="Details Lightbox" />
                        </div>
                        <div className="lg:col-span-4">
                            <h3 className="text-2xl font-bold mb-2">Configuração de alvos</h3>
                            <hr className="w-11 h-0.5 bg-indigo-600 mb-4" />
                            <p className="mb-4">
                                Organiza pode facilmente monitorar a evolução do seu desenvolvimento pessoal, se tirar um tempo para configurar.
                            </p>
                            <h4 className="mt-7 mb-2.5">Feedback de um usuário</h4>
                            <p className="mb-4">
                                Este é um excelente app que pode te ajudar a usar melhor o tempo e deixar a tua vida mais fácil. Também vai te ajudar a melhorar a produtividade.
                            </p>
                            <ul className="space-y-2 mb-6">
                                {['Gráfico estatístico', 'Design no estilo de eventos de calendário', 'Interface intuitiva'].map((item, index) => (
                                    <li key={index} className="flex items-center">
                                        <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                        <span>{item}</span>
                                    </li>
                                ))}
                            </ul>
                            <Link href={route('register')} className="inline-block bg-[#1b1b18] text-white px-6 py-2 rounded-sm mr-2">
                                Criar conta
                            </Link>
                            <button
                                className="inline-block bg-transparent border border-gray-300 text-sm px-6 py-2 rounded-sm"
                                onClick={() => document.getElementById('details-lightbox')?.classList.add('hidden')}
                            >
                                Voltar
                            </button>
                        </div>
                    </div>
                </div>

                {/* Details 3 */}
                <div className="pt-16 pb-12">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
                        <div className="lg:col-span-5">
                            <div className="mb-16 lg:mb-0 xl:mt-16">
                                <h2 className="text-3xl font-bold mb-6">Atualizações constantes</h2>
                                <p className="mb-4">
                                    Organiza não fica desatualizado, sempre que surge uma nova forma eficiente de gestão de tempo o Organiza considera a adoção.
                                </p>
                                <p>
                                    Por tanto, com o Organiza você sempre terá as melhores ferramentas de gestão de tempo
                                </p>
                            </div>
                        </div>
                        <div className="lg:col-span-7">
                            <div className="xl:ml-14">
                                <img className="inline" src="/assets/images/managers-adjusting-clock-hands_74855-4436.jpg" alt="Updates" />
                            </div>
                        </div>
                    </div>
                </div>

                {/* Statistics */}
                <div className="py-12 bg-gray-100 dark:bg-[#1b1b18]">
                    <div className="container mx-auto px-4 sm:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        {[
                            { count: 231, label: 'Usuários Indicados' },
                            { count: 45, label: 'Problemas resolvidos' },
                            { count: 120, label: 'Boas Avaliações' },
                            { count: 27, label: 'Casos de Estudos' },
                            { count: 6950, label: 'Pedidos Associados' },
                        ].map((stat, index) => (
                            <div key={index} className="text-center">
                                <div className="text-4xl font-bold">{stat.count}</div>
                                <p className="text-sm">{stat.label}</p>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Testimonials */}
                <div id="testimonials" className="py-16 dark:bg-[#1b1b18]">
                    <div className="container mx-auto px-4 sm:px-8">
                        <h2 className="mb-12 text-center lg:max-w-xl lg:mx-auto">O que os nossos usuários dizem</h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {[
                                { img: 'testimonial-1.jpg', quote: 'Tem sido tão bom trabalhar com Organiza, integrei ele no meu fluxo de trabalho e na minha rotina diária, é incrível.', author: 'Jane Doe - Designer' },
                                { img: 'testimonial-2.jpg', quote: 'Estávamos tão focados em lançar novos serviços que nos esquecemos da boa gestão das tarefas, Organiza tem nos ajudado muito nisso.', author: 'John Smith - Developer' },
                                { img: 'testimonial-3.jpg', quote: 'Estava a procura de uma ferramenta como o Organiza a tanto tempo. Amo as notificações dele e a sincronização de dispositivos', author: 'Maria Silva - Manager' },
                                { img: 'testimonial-4.jpg', quote: 'Usei outros softwares durante muito tempo, por isso hesitei em usar o Organiza, mas quando provei decidi nunca mais largar.', author: 'Carlos Lima - CEO' },
                                { img: 'testimonial-5.jpg', quote: 'Existem apps por aí afora semelhantes ao Kanban, mas para mim ele é o ideal, suas funcionalidades são incríveis.', author: 'Ana Costa - Accountant' },
                                { img: 'testimonial-6.jpg', quote: 'O time de suporte do app é incrível. Eles já me ajudaram com alguns problemas e eu sou muito grata ao time inteiro.', author: 'Beatriz Mendes - PMO' },
                            ].map((testimonial, index) => (
                                <div key={index} className="bg-white dark:bg-[#2d2d2a] rounded-lg shadow p-6">
                                    <img src={`/assets/images/${testimonial.img}`} alt={testimonial.author} className="w-full h-32 object-cover rounded mb-4" />
                                    <p className="italic mb-3">{testimonial.quote}</p>
                                    <p className="font-semibold">{testimonial.author}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Pricing */}
                <div id="pricing" className="py-16">
                    <div className="container mx-auto px-4 sm:px-8">
                        <h2 className="text-3xl font-bold mb-2.5 lg:max-w-xl lg:mx-auto">Opções de preço</h2>
                        <p className="mb-16 text-center lg:max-w-md lg:mx-auto">
                            Nossos preços são feitos de tal modo que qualquer usuário pode desfrutar deles sem se preocupar demais com os custos.
                        </p>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {[
                                { title: 'Starter', price: '0', frequency: '', desc: 'Plataforma básica gratuita.', features: ['Funcionalidade', 'Funcionalidade', 'Funcionalidade'] },
                                { title: 'Pro', price: '3500', frequency: 'mensalmente', desc: 'Premium para startups.', features: ['Funcionalidade', 'Funcionalidade', 'Funcionalidade'] },
                                { title: 'Enterprise', price: '5000', frequency: 'mensalmente', desc: 'Solução completa.', features: ['Funcionalidade', 'Funcionalidade', 'Funcionalidade'] },
                            ].map((plan, index) => (
                                <div key={index} className="bg-white dark:bg-[#1b1b18] rounded-lg shadow-lg p-6 text-center">
                                    <div className="text-xl font-semibold mb-2">{plan.title}</div>
                                    <div className="text-3xl font-bold mb-2">
                                        <span className="text-sm">Kz</span> {plan.price}
                                    </div>
                                    {plan.frequency && <div className="text-sm mb-4">{plan.frequency}</div>}
                                    <p className="mb-4">{plan.desc}</p>
                                    <ul className="space-y-2 mb-6 text-left">
                                        {plan.features.map((feature, idx) => (
                                            <li key={idx} className="flex items-center">
                                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                                <span>{feature}</span>
                                            </li>
                                        ))}
                                    </ul>
                                    <Link href="#download" className="inline-block bg-[#1b1b18] text-white dark:bg-[#EDEDEC] dark:text-[#1b1b1b18] px-6 py-2 rounded-sm hover:bg-[#62605b]">
                                        Subscrever
                                    </Link>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Conclusion */}
                <div id="download" className="py-12">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                        <div className="mb-16">
                            <img src="/assets/images/2539.jpg" alt="Organiza App" />
                        </div>
                        <div className="lg:mt-24 xl:mt-44 xl:ml-12">
                            <p className="mb-9 text-2xl leading-10">
                                Dê uma chance ao Organiza, repavo: Tenho certeza que vais amar!
                            </p>
                            <Link href={route('register')} className="inline-block bg-[#1b1b18] text-white px-6 py-3 rounded-sm mr-2">
                                Criar conta
                            </Link>
                            <Link href={route('login')} className="inline-block bg-transparent border border-[#19140035] text-[#1b1b18] px-6 py-3 rounded-sm hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                                Acessar
                            </Link>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="py-12 bg-gray-100 dark:bg-[#1b1b18]">
                    <div className="container mx-auto px-4 sm:px-8">
                        <h4 className="mb-8 lg:max-w-3xl lg:mx-auto text-center">
                            Organiza é uma aplicação para organização de tarefas e processos e você pode entrar em contacto com o time em{' '}
                            <a href="mailto:Organiza@gmail.com" className="text-indigo-600 hover:text-gray-500">
                                Organiza@gmail.com
                            </a>
                        </h4>
                        <div className="flex justify-center gap-4">
                            {['facebook-f', 'twitter', 'pinterest-p', 'instagram', 'youtube'].map((icon, index) => (
                                <a key={index} href="#your-link" className="text-2xl">
                                    <span className="relative inline-block w-10 h-10">
                                        <i className="fas fa-circle absolute text-gray-300"></i>
                                        <i className={`fab fa-${icon} relative z-10 text-indigo-600 hover:text-pink-500`}></i>
                                    </span>
                                </a>
                            ))}
                        </div>
                    </div>
                </footer>

                {/* Copyright */}
                <div className="py-6 bg-gray-100 dark:bg-[#1b1b18]">
                    <div className="container mx-auto px-4 sm:px-8 lg:grid lg:grid-cols-3 gap-4">
                        <ul className="list-none mb-4">
                            <li className="mb-2">
                                <Link href="/terms">Termos & Condições</Link>
                            </li>
                            <li className="mb-2">
                                <Link href="/privacy">Política de Privacidade</Link>
                            </li>
                        </ul>
                        <p className="text-sm">
                            Copyright © <a href="#your-link" className="no-underline">Organiza</a>
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}