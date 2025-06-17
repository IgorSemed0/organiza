import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Anexo de Chat">
            <Head title="Detalhes do Anexo de Chat" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Detalhes do Anexo de Chat</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.chat_anexos.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Mensagem de Chat</h3>
                            <p className="text-gray-900 dark:text-white">{item.chat_mensagem?.vc_texto_mensagem || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Utilizador que Carregou</h3>
                            <p className="text-gray-900 dark:text-white">{item.user_upload?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Nome do Arquivo</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_nome_arquivo}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Caminho do Arquivo</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_caminho_arquivo}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criado Em</h3>
                            <p className="text-gray-900 dark:text-white">{new Date(item.created_at).toLocaleString('pt-PT')}</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}