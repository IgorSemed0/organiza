import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Cartão">
            <Head title="Detalhes do Cartão" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Detalhes do Cartão</CardTitle>
                        <Link href={route('admin.cartaos.index')}>
                            <Button variant="outline">Voltar</Button>
                        </Link>
                    </div>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Título</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_titulo}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Lista</h3>
                            <p className="text-gray-900 dark:text-white">{item.lista?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criador</h3>
                            <p className="text-gray-900 dark:text-white">{item.user_criador?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Descrição</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_descricao || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Data de Vencimento</h3>
                            <p className="text-gray-900 dark:text-white">{item.dt_data_vencimento ? new Date(item.dt_data_vencimento).toLocaleDateString('pt-PT') : 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Ordem</h3>
                            <p className="text-gray-900 dark:text-white">{item.it_ordem || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criado Em</h3>
                            <p className="text-gray-900 dark:text-white">{new Date(item.created_at).toLocaleString('pt-PT')}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Etiquetas</h3>
                            {item.etiquetas?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.etiquetas.map((etiqueta) => (
                                        <li key={etiqueta.id} className="text-gray-900 dark:text-white">{etiqueta.vc_nome}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhuma etiqueta</p>
                            )}
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Anexos</h3>
                            {item.anexos?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.anexos.map((anexo) => (
                                        <li key={anexo.id} className="text-gray-900 dark:text-white">{anexo.vc_nome_arquivo || 'N/A'}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhum anexo</p>
                            )}
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Comentários</h3>
                            {item.comentarios?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.comentarios.map((comentario) => (
                                        <li key={comentario.id} className="text-gray-900 dark:text-white">{comentario.vc_texto}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhum comentário</p>
                            )}
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Membros</h3>
                            {item.membros?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.membros.map((membro) => (
                                        <li key={membro.id} className="text-gray-900 dark:text-white">{membro.user?.vc_nome || 'N/A'}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhum membro</p>
                            )}
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Listas de Verificação</h3>
                            {item.listasVerificacaos?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.listasVerificacaos.map((lista) => (
                                        <li key={lista.id} className="text-gray-900 dark:text-white">{lista.vc_titulo || 'N/A'}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhuma lista de verificação</p>
                            )}
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}