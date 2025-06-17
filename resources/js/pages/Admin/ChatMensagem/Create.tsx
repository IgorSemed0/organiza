import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ quadros, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_quadro: '',
        it_id_user_autor: '',
        vc_texto_mensagem: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.chat_mensagems.store'));
    };

    return (
        <AdminLayout title="Criar Mensagem de Chat">
            <Head title="Criar Mensagem de Chat" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Mensagem de Chat</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.chat_mensagems.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_quadro">Quadro</Label>
                            <Select
                                value={data.it_id_quadro}
                                onValueChange={(value) => setData('it_id_quadro', value)}
                            >
                                <SelectTrigger id="it_id_quadro" className={errors.it_id_quadro ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um quadro" />
                                </SelectTrigger>
                                <SelectContent>
                                    {quadros.map((quadro) => (
                                        <SelectItem key={quadro.id} value={quadro.id.toString()}>
                                            {quadro.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_quadro && <p className="text-sm text-red-500">{errors.it_id_quadro}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_autor">Autor</Label>
                            <Select
                                value={data.it_id_user_autor}
                                onValueChange={(value) => setData('it_id_user_autor', value)}
                            >
                                <SelectTrigger id="it_id_user_autor" className={errors.it_id_user_autor ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_autor && <p className="text-sm text-red-500">{errors.it_id_user_autor}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_texto_mensagem">Mensagem</Label>
                            <Input
                                id="vc_texto_mensagem"
                                type="text"
                                value={data.vc_texto_mensagem}
                                onChange={(e) => setData('vc_texto_mensagem', e.target.value)}
                                className={errors.vc_texto_mensagem ? 'border-red-500' : ''}
                            />
                            {errors.vc_texto_mensagem && <p className="text-sm text-red-500">{errors.vc_texto_mensagem}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}